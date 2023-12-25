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
                                    me.addMessageContainer(me, lineTalk.fromTo, [], lineTalk.lineTalkContent.message);
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
                                    me.addMessageContainer(me, lineTalk.fromTo, [], lineTalk.lineTalkContent.message);
                                    break;
                            }
                        }
                        //let captions = [];
                        //captions.push(lineTalk.sender);
                        //captions.push(lineTalk.sendTime);

                        //me.addMessageContainer(me, lineTalk.fromTo, captions, 'aaaaa');
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
        let html = '';
        html += '<div class="container">';
        html += '<div class="separator">';
        html += '<div></div>';
        html += '<div>' + caption + '</div>';
        html += '<div></div>';
        html += '</div>';
        html += '</div>';
        me.$talkContainer.append(html);
    }

    addLabelContainer(me, caption, label, color = '') {
        let html = '';
        html += '<div class="container">';
        html += '<div class="labelContainer">';
        html += '<div class="caption">' + caption + '</div>';
        html += '<div class="label ' + color + '">' + label + '</div>';
        html += '</div>';
        html += '</div>';
        me.$talkContainer.append(html);
    }

    addMessageContainer(me, fromTo, captions, message) {
        let html = '';
        html += '<div class="container">';
        html += '<div class="messageContainer ' + fromTo + '">';
        html += '<div class="caption">';
        for (let i = 0; i < captions.length; i++) {
            html += '<div>' + captions[i] + '</div>';
        }
        html += '</div>';
        html += '<div class="messageBox">';
        if (message == null) {
            html += '<div class="message fc-red fw-bold">メッセージ履歴の保存に失敗</div>';
        } else {
            html += '<div class="message">' + StringUtil.replaceNewLine(message) + '</div>';
        }
        html += '</div>';
        html += '</div>';
        html += '</div>';
        me.$talkContainer.append(html);
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