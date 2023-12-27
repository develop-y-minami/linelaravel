/**
 * LineTalkContainer
 * 
 */
class LineTalkContainer {
    /**
     * コンテナー
     * 
     */
    $container;
    /**
     * LINEトーク履歴表示期間セレクトボックス
     * 
     */
    $selLineTalkHistoryTerm;
    /**
     * トーク履歴一覧ページへボタン
     * 
     */
    $btnLineTalkHistory;
    /**
     * リロードボタン
     * 
     */
    $btnReload;
    /**
     * トークコンテナー
     * 
     */
    $talkContainer;
    /**
     * ローディングオーバーレイ
     * 
     */
    $loadingOverlay;
    /**
     * LINE情報ID
     * 
     */
    lineId;

    /**
     * 
     * @param {string} id コンテナーID
     */
    constructor(id = 'lineTalkContainer') {
        this.$container = $('#' + id);
        this.$selLineTalkHistoryTerm = $('#' + id + 'SelLineTalkHistoryTerm');
        this.$btnLineTalkHistory = $('#' + id + 'BtnLineTalkHistory');
        this.$btnReload = $('#' + id + 'BtnReload');
        this.$talkContainer = $('#' + id + 'TalkContainer');
        this.$loadingOverlay = $('#' + id + 'LoadingOverlay');
        this.lineId = Number($('#' + id + 'TxtLineId').val());

        // イベント設定
        this.$selLineTalkHistoryTerm.on('change', { me : this }, this.changeSelLineTalkHistoryTerm)
        this.$btnLineTalkHistory.on('click', { me : this }, this.clickBtnLineTalkHistory)
        this.$btnReload.on('click', { me : this }, this.clickBtnReload)
    }

    /**
     * 初期化処理
     * 
     */
    async init() {
        try {
            // トークコンテナーを設定
            await this.setLineTalkContainer(this, this.lineId, Number(this.$selLineTalkHistoryTerm.val()));
        } catch(error) {
            console.error(error);
        }
    }

    /**
     * トークコンテナーを設定
     * 
     * @param {class}  me                  this
     * @param {number} lineId              LINE情報ID
     * @param {number} lineTalkHistoryTerm LINEトーク履歴表示期間
     */
    async setLineTalkContainer(me, lineId, lineTalkHistoryTerm) {
        try {
            // コンテナー内のメッセージを全て削除
            me.$talkContainer.empty();

            // API経由でLINEトーク履歴を取得
            let result = await LineApi.lineTalkHistorys(lineId, lineTalkHistoryTerm);
            if (result.status == FetchApi.STATUS_SUCCESS) {
                // データを取得
                let lineTalkHistorys = result.data.lineTalkHistorys;
                let line = result.data.line;

                for (let i = 0; i < lineTalkHistorys.length; i++) {
                    // データを取得
                    let lineTalkHistory = lineTalkHistorys[i];

                    // 日付セパレーターを追加
                    me.addSeparator(me, DateTimeUtil.convertJpDate(lineTalkHistory.talkDate));

                    for (let j = 0; j < lineTalkHistory.lineTalks.length; j++) {
                        // データを取得
                        let lineTalk = lineTalkHistory.lineTalks[j];

                        // 送信日時を取得
                        let sendTime = DateTimeUtil.convertJpTime(lineTalk.sendTime);

                        if (lineTalk.fromTo === 'to') {
                            // LINE通知種別に対応するコンテナーを追加
                            switch (lineTalk.typeId) {
                                case LineNoticeType.MESSAGE:
                                    if (lineTalk.lineTalkContent !== null) {
                                        switch (lineTalk.lineTalkContent.messageType) {
                                            case LineMessageType.TEXT :
                                                // テキスト形式
                                                me.addMessageContainer(me, line, lineTalk);       
                                                break;
                                            case LineMessageType.IMAGE :
                                                // 画像形式
                                                if (lineTalk.lineTalkContent.images.length > 1) {

                                                } else {
                                                    // 画像を追加
                                                    me.addImageContainer(me, line, lineTalk);
                                                }
                                                break;
                                        }
                                    } else {
                                        me.addMessageContainer(me, line, lineTalk);
                                    }
                                    break;
                                case LineNoticeType.UNSEND:
                                case LineNoticeType.FOLLOW:
                                case LineNoticeType.UNFOLLOW:
                                case LineNoticeType.JOIN:
                                case LineNoticeType.LEAVE:
                                case LineNoticeType.MEMBER_JOINED:
                                case LineNoticeType.MEMBER_LEFT:
                                case LineNoticeType.POSTBACK:
                                case LineNoticeType.VIDEO_PLAY_COMPLETE:
                                    // ラベル色を設定
                                    let color = '';
                                    if (lineTalk.typeId === LineNoticeType.UNSEND
                                        || lineTalk.typeId === LineNoticeType.UNFOLLOW
                                        || lineTalk.typeId === LineNoticeType.LEAVE
                                        || lineTalk.typeId === LineNoticeType.MEMBER_LEFT) {
                                        color = 'red';
                                    } else if (lineTalk.typeId === LineNoticeType.FOLLOW
                                        || lineTalk.typeId === LineNoticeType.JOIN
                                        || lineTalk.typeId === LineNoticeType.MEMBER_JOINED) {
                                        color = 'green';
                                    } else if (lineTalk.typeId === LineNoticeType.POSTBACK
                                        || lineTalk.typeId === LineNoticeType.VIDEO_PLAY_COMPLETE) {
                                        color = 'blue';
                                    }

                                    // ラベルコンテナーを追加
                                    me.addLabelContainer(me, sendTime, lineTalk.typeName, color);
                                    break;
                            }
                        } else if (lineTalk.fromTo === 'from') {
                            switch (lineTalk.typeId) {
                                case LineSendMessageType.TEXT:
                                    me.addMessageContainer(me, line, lineTalk);
                                    break;
                            }
                        }
                    }
                }

                // スクロールを一番下に設定
                me.$talkContainer.scrollTop(me.$talkContainer[0].scrollHeight);
            }
        } catch(error) {
            throw error;
        }
    }

    /**
     * トークコンテナーにセパレーターを追加
     * 
     * @param {class}  me      this
     * @param {string} display 表示文字列
     */
    addSeparator(me, caption) {
        // HTML生成
        let html = '';
        html += '<div class="container">';
        html += '<div class="separator">';
        html += '<div></div>';
        html += '<div>' + caption + '</div>';
        html += '<div></div>';
        html += '</div>';
        html += '</div>';

        // コンテナーに追加
        me.$talkContainer.append(html);
    }

    /**
     * トークコンテナーにラベルを追加
     * 
     * @param {class}  me      this
     * @param {string} caption 見出し
     * @param {string} label   表示名
     * @param {string} color   ラベルカラー 
     */
    addLabelContainer(me, caption, label, color = '') {
        // HTML生成
        let html = '';
        html += '<div class="container">';
        html += '<div class="labelContainer">';
        html += '<div class="caption">' + caption + '</div>';
        html += '<div class="label ' + color + '">' + label + '</div>';
        html += '</div>';
        html += '</div>';

        // コンテナーに追加
        me.$talkContainer.append(html);
    }

    /**
     * トークコンテナーにメッセージを追加
     * 
     * @param {class}  me       this
     * @param {object} line     LINE情報
     * @param {object} lineTalk LINEトーク情報
     */
    addMessageContainer(me, line, lineTalk) {
        let fromTo = lineTalk.fromTo;
        let sender = lineTalk.sender;
        let sendTime = lineTalk.sendTime;
        let message = lineTalk.lineTalkContent.message;

        // HTML生成
        let html = '';
        html += '<div class="container">';
        html += '<div class="messageContainer ' + fromTo + '">';

        // 見出し部のHTMLを取得
        html += me.getCaptionHtml(fromTo, line.lineAccountType.id, sender, sendTime);

        // メッセージ部のHTMLを生成
        html += '<div class="messageBox">';
        if (message == null) {
            // メッセージが存在しない場合はエラー
            html += '<div class="message fc-red fw-bold">メッセージ履歴の保存に失敗</div>';
        } else {
            html += '<div class="message">' + StringUtil.replaceNewLine(message) + '</div>';
        }
        html += '</div>';
        html += '</div>';
        html += '</div>';

        // コンテナーに追加
        me.$talkContainer.append(html);
    }

    /**
     * トークコンテナーに画像を追加
     * 
     * @param {class}  me       this
     * @param {object} line     LINE情報
     * @param {object} lineTalk LINEトーク情報
     */
    addImageContainer(me, line, lineTalk) {
        let fromTo = lineTalk.fromTo;
        let sender = lineTalk.sender;
        let sendTime = lineTalk.sendTime;
        let image = lineTalk.lineTalkContent.images[0];

        // HTML生成
        let html = '';
        html += '<div class="container">';
        html += '<div class="imageContainer ' + fromTo + '">';
        
        // 見出し部のHTMLを取得
        html += me.getCaptionHtml(fromTo, line.lineAccountType.id, sender, sendTime);

        // 画像部のHTMLを生成
        html += '<div class="imageBox">';
        html += '<img src="/' + image.filePath +'">';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        // コンテナーに追加
        me.$talkContainer.append(html);
    }

    /**
     * 見出し部のHTMLを生成
     * 
     * @param {string} fromTo          FROM/TO
     * @param {int}    lineAccountType LINEアカウント種別
     * @param {string} sender          送信者
     * @param {string} sendTime        送信日時
     * @returns {string} HTML
     */
    getCaptionHtml(fromTo, lineAccountType, sender, sendTime) {
        // HTML生成
        let html = '';
        html += '<div class="caption">';
        if (fromTo === 'to') {
            if (lineAccountType === LineAccountType.GROUP) {
                // グループトークの場合は送信者を表示
                html += '<div>' + sender + '</div>';
            }
            // 送信日時を表示
            html += '<div>' + DateTimeUtil.convertJpTime(sendTime) + '</div>';
        } else if (fromTo === 'from') {
            // 送信者を表示
            html += '<div>' + sender + '</div>';
            // 送信日時を表示
            html += '<div>' + DateTimeUtil.convertJpTime(sendTime) + '</div>';
        }
        html += '</div>';
        
        return html;
    }

    /**
     * LINEトーク履歴表示期間セレクトボックス変更時
     * 
     * @param {Event} e 
     */
    async changeSelLineTalkHistoryTerm(e) {
        let me = e.data.me;

        try {
            // ローディングオーバレイを表示
            me.$loadingOverlay.show();

            // トークコンテナーを設定
            await me.setLineTalkContainer(me, me.lineId, Number(me.$selLineTalkHistoryTerm.val()));

        } catch(error) {
            console.error(error);
        } finally {
            // ローディングオーバレイを非表示
            me.$loadingOverlay.hide();
        }
    }

    /**
     * トーク履歴一覧ページへボタンボタンクリック時
     * 
     * @param {Event} e 
     */
    clickBtnLineTalkHistory(e) {
        
    }

    /**
     * リロードボタンクリック時
     * 
     * @param {Event} e 
     */
    async clickBtnReload(e) {
        let me = e.data.me;

        try {
            // ローディングオーバレイを表示
            me.$loadingOverlay.show();

            // トークコンテナーを設定
            await me.setLineTalkContainer(me, me.lineId, Number(me.$selLineTalkHistoryTerm.val()));

        } catch(error) {
            console.error(error);
        } finally {
            // ローディングオーバレイを非表示
            me.$loadingOverlay.hide();
        }
    }
}