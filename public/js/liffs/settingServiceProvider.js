/**
 * LIFF ID
 * 
 */
const LIFF_ID = '2001775635-RaakXW0d';

$(function() {
    /**
     * LIFFページ種別情報ID
     * 
     */
    $txtLiffPageId = $('#txtLiffPageId');
    /**
     * LINE情報ID
     * 
     */
    $txtLineId = $('#txtLineId');
    /**
     * 提供者ID
     * 
     */
    $txtProviderId = $('#txtProviderId');
    /**
     * 設定ボタン
     * 
     */
    $btnSetting = $('#btnSetting');
    /**
     * LIFFページ種別情報ID
     * 
     */
    $liffPageId = Number($txtLiffPageId.val());
    /**
     * LINE情報ID
     * 
     */
    $lineId = Number($txtLineId.val());
    /**
     * エラーメッセージ
     * 
     */
    errorMessage = new ErrorMessage();

    /**
     * init
     * 
     */
    liff.init({liffId: LIFF_ID}).then(() => {
        // 初期化完了

        // 起動OSを確認しページが表示可能か取得
        let checkOsResult = checkOs();

        if (checkOsResult === true) {
            // ページを表示
            $page.fadeIn();
        } else {
            // アラートを表示
            showAlertMistakeOs();
        }
    }).catch(function(error) {
        // 初期化失敗
        showAlertLiffInitFailure();
    });

    /**
     * 設定ボタンクリック時
     * 
     * @param {Event} e
     */
    $btnSetting.on('click', async function(e) {
        try {
            // エラーメッセージを非表示
            errorMessage.hide();

            // ローディングオーバレイを表示
            showLoadingOverlay();

            // パラメータを取得
            let providerId = $txtProviderId.val().trim();

            // サービス提供者情報を確認
            let result = await LiffApi.verifyServiceProvider(providerId);

            if (result.status == FetchApi.STATUS_SUCCESS) {
                
                liff.sendMessages([
                    {
                    type: "text",
                    text: "Hello, World!",
                    },
                ])
                .then(() => {
    
    
                    console.log("message sent");
                })
                .catch((error) => {
                    showAlertSendMessages();
                });

            } else {
                if (result.code === FetchApi.STATUS_CODE_VALIDATION_EXCEPTION) {
                    // バリデーションエラー時のメッセージを表示
                    let erros = [];
                    for (let i = 0; i < result.errors.length; i++) {
                        erros.push(result.errors[i].message);
                    }
                    errorMessage.showMessages(erros);
                } else {
                    errorMessage.showServerError();
                }
            }
        } catch(error) {
            alert(error);
        } finally {
            // ローディングオーバレイを非表示
            hideLoadingOverlay();
        }
    })
});