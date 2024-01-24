/**
 * ServiceProviderCellRenderer
 * 
 */
class ServiceProviderCellRenderer {
    /**
     * eGui
     * 
     */
    eGui;

    /**
     * init
     * 
     * @param {object} params 
     */
    init(params) {
        this.params = params;

        // 利用状態ラベルのカラーを設定
        let labelColor = ''
        if (params.data.useStopFlg === true) {
            labelColor = 'red';
        } else {
            labelColor = 'green';
        }

        // コンテナー
        this.eGui = document.createElement('div');
        this.eGui.classList.add('detailInfoContainer');

        // サービス提供者情報テーブル
        let tableGui = document.createElement('div');
        let tableHtml = '';
        tableHtml += '<div class="tableContainer">';
        tableHtml += '<table class="infoTable">';
        tableHtml += '<tbody>';
        tableHtml += '<tr>';
        tableHtml += '<th>提供者ID</th>';
        tableHtml += '<td><a href="\\serviceProvider\\' + params.data.id + '">' + params.data.providerId + '</a></td>';
        tableHtml += '</tr>';
        tableHtml += '<tr>';
        tableHtml += '<th>提供者名</th>';
        tableHtml += '<td>' + params.data.name + '</td>';
        tableHtml += '</tr>';
        tableHtml += '<tr>';
        tableHtml += '<th>利用開始日</th>';
        tableHtml += '<td>' + DateTimeUtil.convertJpDate(params.data.useStartDate) + '</td>';
        tableHtml += '</tr>';
        tableHtml += '<tr>';
        tableHtml += '<th>利用終了日</th>';
        tableHtml += '<td>' + DateTimeUtil.convertJpDate(params.data.useEndDate) + '</td>';
        tableHtml += '</tr>';
        tableHtml += '</tbody>';
        tableHtml += '</table>';
        tableHtml += '</div>';
        tableGui.classList.add('row');
        tableGui.innerHTML = tableHtml;

        // 利用状態
        let labelBoxGui = document.createElement('div');
        let labelBoxhtml = '<div class="labelBox ' + labelColor + '">' + params.data.useStopName + '</div>';
        labelBoxGui.classList.add('row');
        labelBoxGui.innerHTML = labelBoxhtml;

        // HTMLを設定
        this.eGui.appendChild(tableGui);
        this.eGui.appendChild(labelBoxGui);

        if (globalUserAccountType == UserAccountType.ADMIN) {
            // 編集ボタン
            let btnEditGui = document.createElement('div');
            let btnEdithtml = '<button id="' + params.btnEditId + '" class="button green">編集</button>';
            btnEditGui.classList.add('row');
            btnEditGui.innerHTML = btnEdithtml;
            // 編集ボタンイベント設定
            this.btnEditClickedHandler = this.btnEditClickedHandler.bind(this);
            btnEditGui.addEventListener('click', this.btnEditClickedHandler);

            // 削除ボタン
            let btnDeleteGui = document.createElement('div');
            let btnDeletehtml = '<button id="' + params.btnDeleteId + '" class="button red">削除</button>';
            btnDeleteGui.classList.add('row');
            btnDeleteGui.innerHTML = btnDeletehtml;
            // 削除ボタンイベント設定
            this.btnDeleteClickedHandler = this.btnDeleteClickedHandler.bind(this);
            btnDeleteGui.addEventListener('click', this.btnDeleteClickedHandler);

            // HTMLを設定
            this.eGui.appendChild(btnEditGui);
            this.eGui.appendChild(btnDeleteGui);
        }
    }

    /**
     * getGui
     * 
     * @returns this.eGui
     */
    getGui() {
        return this.eGui;
    }

    /**
     * refresh
     * 
     * @param {object} params 
     * @returns {boolean}
     */
    refresh(params) {
        return true;
    }

    /**
     * 編集ボタンクリック時
     * 
     * @param {Event} e 
     */
    btnEditClickedHandler(e) {
        this.params.btnEditClicked(e, this.params);
    }

    /**
     * 削除ボタンクリック時
     * 
     * @param {Event} e 
     */
    btnDeleteClickedHandler(e) {
        this.params.btnDeleteClicked(e, this.params);
    }
}