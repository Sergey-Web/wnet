<div class="container">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                    <div class="form-check">
                        <input type="radio" name="searchType" id="contractId" value="contract_id" checked>
                        <label class="form-check-label" for="contractId">
                            Contract Id
                        </label>
                    </div>

                <div class="form-check">
                    <input type="radio" name="searchType" id="contractNumber" value="number">
                    <label class="form-check-label" for="contractNumber">
                        Contract Number
                    </label>
                </div>
            </div>
        </div>
        <div class="input-group-text">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="status[]" id="statusWork" value="work" checked>
                <label class="form-check-label" for="statusWork">work</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="status[]" id="statusConnecting" value="connecting" checked>
                <label class="form-check-label" for="statusConnecting">connecting</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="status[]" id="statusDisconnected" value="disconnected" checked>
                <label class="form-check-label" for="statusDisconnected">disconnected</label>
            </div>
        </div>
        <input type="text" id="searchContract" class="form-control" aria-label="Text input with radio button" placeholder="Search...">
        <button type="submit" id="search">
            <i class="fa fa-search">&#128270;</i>
        </button>
    </div>
    <div class="alert alert-danger" role="alert" id="error" style="display: none">

    </div>
    <div id="contract" hidden>
        <table class="table table-hover">
            <tr>
                <td colspan=2><b>информация про клиента</b></td>
            </tr>
            <tr>
                <td>Имя клиента</td>
                <td id="clientName"></td>
            </tr>
            <tr>
                <td>компания</td>
                <td id="company"></td>
            </tr>
            <tr>
                <td colspan=2><b>информация про договор</b></td>
            </tr>
            <tr>
                <td >номер договора</td>
                <td id="contractNum">[ number]</td>
            </tr>
            <tr>
                <td >дата подписания</td>
                <td id="dateSign"></td>
            </tr>
            <tr>
                <td colspan=2><b>информация про сервисы</b></td>
            </tr>
            <tr id="services">
                <!-- в services_name вывести название сервисов через <br> -->
            </tr>
        </table>
    </div>
</div>