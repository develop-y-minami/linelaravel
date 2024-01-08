/**
 * LineCellRenderer
 * 
 */
class LineCellRenderer {
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
        // コンテナー
        this.eGui = document.createElement('div');
        this.eGui.classList.add('detailInfoContainer');

        // LINEプロフィール画像コンテナー
        let circleImgContainerGui = document.createElement('div');
        let circleImgContainerHtml = '';
        circleImgContainerHtml += '<div class="imgBox">';
        circleImgContainerHtml += '<img src="' + params.data.pictureUrl + '">';
        circleImgContainerHtml += '</div>';
        circleImgContainerGui.classList.add('circleImgContainer');
        circleImgContainerGui.innerHTML = circleImgContainerHtml;

        // LINE情報テーブル
        let tableGui = document.createElement('div');
        let tableHtml = '';
        tableHtml += '<div class="tableContainer">';
        tableHtml += '<table class="infoTable">';
        tableHtml += '<tbody>';
        tableHtml += '<tr>';
        tableHtml += '<th>名前</th>';
        tableHtml += '<td><a href="info\\' + params.data.id + '">' + params.data.displayName + '</a></td>';
        tableHtml += '</tr>';
        tableHtml += '<tr>';
        tableHtml += '<th>サービス提供者</th>';
        tableHtml += '<td><a>' + StringUtil.nullToBlank(params.data.serviceProvider.name) + '</a></td>';
        tableHtml += '</tr>';
        tableHtml += '<tr>';
        tableHtml += '<th>担当者</th>';
        tableHtml += '<td><a>' + StringUtil.nullToBlank(params.data.user.name) + '</a></td>';
        tableHtml += '</tr>';
        tableHtml += '</tbody>';
        tableHtml += '</table>';
        tableHtml += '</div>';
        tableGui.classList.add('row');
        tableGui.innerHTML = tableHtml;

        // 状態
        let labelColor = '';
        switch (Number(params.data.lineAccountStatus.id)) {
            case LineAccountStatus.FOLLOW:
            case LineAccountStatus.JOIN:
                labelColor = 'green';
                break;
            case LineAccountStatus.UNFOLLOW:
            case LineAccountStatus.LEAVE:
                labelColor = 'red';
                    break;
        }
        let labelBoxGui = document.createElement('div');
        let labelBoxhtml = '<div class="labelBox ' + labelColor + '">' + params.data.lineAccountStatus.name + '</div>';
        labelBoxGui.classList.add('row');
        labelBoxGui.innerHTML = labelBoxhtml;

        // 右コンテナー
        let rightContainerGui = document.createElement('div');
        rightContainerGui.classList.add('lineInfoRightContainer');
        rightContainerGui.appendChild(tableGui);
        rightContainerGui.appendChild(labelBoxGui);

        // LINE情報コンテナー
        let lineInfoGui = document.createElement('div');
        lineInfoGui.classList.add('lineInfoContainer');
        lineInfoGui.appendChild(circleImgContainerGui);
        lineInfoGui.appendChild(rightContainerGui);

        // HTMLを設定
        this.eGui.appendChild(lineInfoGui);
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
}