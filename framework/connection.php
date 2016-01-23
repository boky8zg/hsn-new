<?php
    class Connection {
        private $dbServer = 'localhost';
        private $dbUserName = 'root';
        private $dbPassword = '0000';
        private $dbName = 'HSN2';
        private $connection;

        function __construct() {
            $this->connection = mysqli_connect(
                $this->dbServer,
                $this->dbUserName,
                $this->dbPassword,
                $this->dbName
            );

            mysqli_set_charset($this->connection, 'utf8');
        }

        function query($queryString, $params = NULL) {
            $queryString = isset($params) ? str_format($queryString, $params) : $queryString;
            $queryResult = mysqli_query($this->connection, $queryString);
            
            if (!is_bool($queryResult)) {
                if (mysqli_num_rows($queryResult) > 0) {
                    $outputArray = array();

                    while ($row = mysqli_fetch_assoc($queryResult)) {
                        $outputArray[] = $row;
                    }

                    mysqli_free_result($queryResult);
                    mysqli_next_result($this->connection);

                    return $outputArray;
                } else {
                    mysqli_free_result($queryResult);
                    mysqli_next_result($this->connection);
                }
            } else {
                mysqli_free_result($queryResult);
                mysqli_next_result($this->connection);
            }

            return FALSE;
        }

        function multi_query($queryString, $params = NULL) {
            $queryString = isset($params) ? str_format($queryString, $params) : $queryString;
            $outputArray = array();

            if (mysqli_multi_query($this->connection, $queryString)) {
                do {
                    if ($queryResult = mysqli_store_result($this->connection)) {
                        $array = array();

                        while ($row = mysqli_fetch_assoc($queryResult)) {
                            $array[] = $row;
                        }
                        
                        $outputArray[] = $array;
                        mysqli_free_result($queryResult);
                    }
                } while (mysqli_next_result($this->connection));

                return $outputArray;
            }

            return FALSE;
        }

        function call($proc, $params = array()) {
            $sParams = join(',', $params);

            return $this->query("CALL $proc($sParams)");
        }

        function multi_call($proc, $params = array()) {
            $sParams = join(',', $params);

            return $this->multi_query("CALL $proc($sParams)");
        }

        function __destruct() {
            mysqli_close($this->connection);
        }
    }
?>