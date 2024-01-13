/**
 * UserCellRenderer
 * 
 */
class UserCellRenderer {
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

        // コンテナー
        this.eGui = document.createElement('div');
        this.eGui.classList.add('detailInfoContainer');

        // プロフィールコンテナー
        let containerGui = document.createElement('div');

        // プロフィール画像コンテナー
        let circleImgContainerGui = document.createElement('div');
        let circleImgContainerHtml = '';
        circleImgContainerHtml += '<div class="imgBox">';
        circleImgContainerHtml += '<img src="' + params.data.profileImageFilePath + '">';
        circleImgContainerHtml += '</div>';
        circleImgContainerGui.classList.add('circleImgContainer');
        circleImgContainerGui.innerHTML = circleImgContainerHtml;

        // サービス提供者情報テーブル
        let tableGui = document.createElement('div');
        let tableHtml = '';
        tableHtml += '<div class="tableContainer">';
        tableHtml += '<table class="infoTable">';
        tableHtml += '<tbody>';
        if (globalUserType == UserType.OPERATOR) {
            tableHtml += '<tr>';
            tableHtml += '<th>担当者種別</th>';
            tableHtml += '<td>' + params.data.userType.name + '</td>';
            tableHtml += '</tr>';
            tableHtml += '<tr>';
            tableHtml += '<th>サービス提供者</th>';
            tableHtml += '<td><a href="">' + StringUtil.nullToBlank(params.data.serviceProvider.name) + '</a></td>';
            tableHtml += '</tr>';
        }
        tableHtml += '<tr>';
        tableHtml += '<th>アカウント種別</th>';
        tableHtml += '<td>' + params.data.userAccountType.name + '</td>';
        tableHtml += '</tr>';
        tableHtml += '<tr>';
        tableHtml += '<th>アカウントID</th>';
        tableHtml += '<td><a href="">' + params.data.accountId + '</a></td>';
        tableHtml += '</tr>';
        tableHtml += '<tr>';
        tableHtml += '<th>担当者名</th>';
        tableHtml += '<td>' + params.data.name + '</td>';
        tableHtml += '</tr>';
        tableHtml += '</tbody>';
        tableHtml += '</table>';
        tableHtml += '</div>';
        tableGui.classList.add('profile');
        tableGui.innerHTML = tableHtml;

        containerGui.classList.add('row', 'profileContainer');
        containerGui.appendChild(circleImgContainerGui);
        containerGui.appendChild(tableGui);


        // HTMLを設定
        this.eGui.appendChild(containerGui);

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