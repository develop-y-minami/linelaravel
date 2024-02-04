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
    let $txtLiffPageId = $('#txtLiffPageId');
    /**
     * LINE情報ID
     * 
     */
    let $txtLineId = $('#txtLineId');
    /**
     * 提供者ID
     * 
     */
    let $txtProviderId = $('#txtProviderId');
    /**
     * 送信ボタン
     * 
     */
    let $btnPost = $('#btnPost');
    /**
     * サービス提供者確認ページ
     * 
     */
    let $verifyServiceProviderPage = $('#verifyServiceProviderPage');
    /**
     * 提供者ID
     * 
     */
    let $providerId = $('#providerId');
    /**
     * 提供者名
     * 
     */
    let $name = $('#name');
    /**
     * 設定ボタン
     * 
     */
    let $btnSetting = $('#btnSetting');
    /**
     * 戻るボタン
     * 
     */
    let $btnBack = $('#btnBack');
    /**
     * LIFFページ種別情報ID
     * 
     */
    let liffPageId = Number($txtLiffPageId.val());
    /**
     * LINE情報ID
     * 
     */
    let lineId = Number($txtLineId.val());
    /**
     * サービス提供者情報ID
     * 
     */
    let serviceProviderId;
    /**
     * エラーメッセージ
     * 
     */
    let errorMessage = new ErrorMessage();
    /**
     * エラーメッセージ（サービス提供者確認ページ）
     * 
     */
    let verifyServiceProviderErrorMessage = new ErrorMessage('verifyServiceProviderErrorMessage');

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
     * 送信ボタンクリック時
     * 
     * @param {Event} e
     */
    $btnPost.on('click', async function(e) {
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
                
                // ローディングオーバレイを非表示
                hideLoadingOverlay();

                // サービス提供者確認ページを表示
                showVerifyServiceProviderPage(result.data.serviceProvider);

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
    });

    /**
     * サービス提供者確認ページを表示
     * 
     * @param {object} serviceProvider サービス提供者情報
     */
    function showVerifyServiceProviderPage(serviceProvider) {
        serviceProviderId = serviceProvider.id;
        $providerId.html(serviceProvider.providerId);
        $name.html(serviceProvider.name);

        // ページを表示
        $verifyServiceProviderPage.show();
    }

    /**
     * 設定ボタンクリック時
     * 
     * @param {Event} e
     */
    $btnSetting.on('click', function(e) {
        try {


            liff.sendMessages([
                {
                    type: "text",
                    text: "Hello, World!",
                },
                {
                    "type": "flex",
                    "altText": "This is a Flex Message",
                    "contents": {
                        "type": "bubble",
                        "header": {
                          "type": "box",
                          "layout": "vertical",
                          "contents": [
                            {
                              "type": "box",
                              "layout": "vertical",
                              "contents": [
                                {
                                  "type": "text",
                                  "text": "サービス提供者情報",
                                  "size": "xs",
                                  "color": "#ff7373"
                                }
                              ],
                              "paddingAll": "xl",
                              "paddingStart": "xl",
                              "paddingEnd": "xl"
                            },
                            {
                              "type": "separator"
                            }
                          ],
                          "paddingAll": "none"
                        },
                        "body": {
                          "type": "box",
                          "layout": "vertical",
                          "contents": [
                            {
                              "type": "box",
                              "layout": "horizontal",
                              "contents": [
                                {
                                  "type": "text",
                                  "text": "提供者ID",
                                  "size": "xs",
                                },
                                {
                                  "type": "text",
                                  "text": "FWFFFFW",
                                  "size": "xs"
                                }
                              ],
                              "paddingAll": "md",
                              "paddingStart": "none",
                              "paddingEnd": "none"
                            },
                            {
                              "type": "box",
                              "layout": "horizontal",
                              "contents": [
                                {
                                  "type": "text",
                                  "text": "提供者名",
                                  "size": "xs",
                                },
                                {
                                  "type": "text",
                                  "text": "hello, world",
                                  "size": "xs"
                                }
                              ],
                              "paddingAll": "md",
                              "paddingStart": "none",
                              "paddingEnd": "none"
                            }
                          ]
                        }
                      }
                },
            ])
            .then(() => {

            })
            .catch((error) => {
                // メッセージ送信失敗
                showAlertSendMessages();
            });

        } catch(error) {
            alert(error);
        } finally {
            // ローディングオーバレイを非表示
            hideLoadingOverlay();
        }
    })

    /**
     * 戻るボタンクリック時
     * 
     * @param {Event} e
     */
    $btnBack.on('click', function(e) { $verifyServiceProviderPage.hide(); });
});