
<div class="content">
    <div class="header">
        <div class="col col-1 extra">
            <h1>
                <?php
                    foreach ($array['categories'] as $category) {
                        if ($category['IDCategory'] == param(1)) {
                            echo $category['Name'];
                            break;
                        }
                    }
                ?>
            </h1>
        </div>
    </div>

    <div class="main">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Naslov</th>
                    <th width="20%">Autori</th>
                    <th width="10%">God. izdanja</th>
                    <th width="15%">ISBN</th>
                    <th width="12%">Cijena s PDV-om</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($array['books'] as $book): ?>
                <tr>
                    <td><?php echo $book['Title']; ?></td>
                    <td>
                        <?php
                            $authors = array();
                            foreach ($book['Authors'] as $author) {
                                $authors[] = $author['Name'];
                            }
                            echo join(', ', $authors);
                        ?>
                    </td>
                    <td><?php echo $book['PublicationYear']; ?></td>
                    <td><?php echo $book['ISBN']; ?></td>
                    <td><?php echo $book['Price']; ?></td>
                </tr>
            <?php endforeach; ?>
             </tbody>
        </table>
    </div>
</div>