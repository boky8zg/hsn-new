<div class="content">
    <div class="header">
        <div class="col col-1">
            <h1>Kontakt</h1>
        </div>

        <div class="col col-2 contact"></div>

        <div class="col col-3 contact">
            <div class="address">
                <address>
                    Hrvatska sveučilišna naklada d.o.o.<br />
                    Ulica grada Vukovara 68<br />
                    10 000 Zagreb<br />
                    Hrvatska/Croatia<br />
                </address>
            </div>

            <div class="telephone">
                <span>Telefoni:</span><br />
                <a href="tel:0038516111240">+385 1 6111 240</a><br />
                <a href="tel:0038516112711">+385 1 6112 711</a><br />
                <a href="tel:0038516112716">+385 1 6112 716</a>
            </div>

            <div class="fax">
                <span>Fax:</span>
                <a>+385 1 6112 718</a>
            </div>

            <div class="email">
                <span>E-mail:</span>
                <a href="mailto:hsn@hsn.hr">hsn@hsn.hr</a>,
                <a href="mailto:prodaja@hsn.hr">prodaja@hsn.hr</a>
            </div>

            <br />

            <div class="oib">
                <span>OIB:</span>
                58597177555
            </div>

            <div class="iban">
                <span>IBAN:</span>
                HR4723600001101346739
            </div>

            <div class="working-hours">
                <span>Radno vrijeme:</span>
                Pon - Pet, 08:00 - 16:00h
            </div>
        </div>
    </div>

    <div class="main">
        <form class="form-horizontal" id="form-contact">
            <!-- Vaše ime -->
            <div class="form-group">
                <label for="input-name" class="col-sm-2 control-label">Vaše ime:</label>
                <div class="col-sm-4">
                    <input type="text" name="name" class="form-control" id="input-name" placeholder="Ime i prezime" autofocus="true">
                </div>
            </div>

            <!-- E-mail -->
            <div class="form-group">
                <label for="input-email" class="col-sm-2 control-label">E-mail:</label>
                <div class="col-sm-4">
                    <input type="email" name="email" class="form-control" id="input-email" placeholder="E-mail">
                </div>
            </div>

            <!-- Broj telefona -->
            <div class="form-group">
                <label for="input-phone" class="col-sm-2 control-label">Broj telefona:</label>
                <div class="col-sm-4">
                    <input type="text" name="phone" class="form-control" id="input-phone" placeholder="Telefon">
                </div>
            </div>

            <!-- Predmet -->
            <div class="form-group">
                <label for="input-subject" class="col-sm-2 control-label">Predmet:</label>
                <div class="col-sm-4">
                    <input type="text" name="subject" class="form-control" id="input-subject" placeholder="Predmet">
                </div>
            </div>

            <!-- Poruka -->
            <div class="form-group">
                <label for="text" class="col-sm-2 control-label">Poruka:</label>
                <div class="col-sm-4">
                    <textarea name="body" class="form-control" id="text" placeholder="Unesite poruku..." rows="8"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-default" id="submit-mail">Pošalji</button>
                </div>
            </div>
        </form>

        <div id="form-modal-success" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Poslano</h4>
                    </div>
                    <div class="modal-body">
                        <p>E-mail je uspješno poslan.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">U redu</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="form-modal-fail" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Pogreška</h4>
                    </div>
                    <div class="modal-body">
                        <p>Dogodila se pogreška. Nažalost e-mail nije poslan.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">U redu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>