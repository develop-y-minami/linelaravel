/**
 * 起動OS：ios
 * 
 */
const OS_IOS = 'ios';
/**
 * 起動OS：android
 * 
 */
const OS_ANDROID = 'android';
/**
 * 起動OS：ios、android以外
 * 
 */
const OS_WEB = 'web';

/**
 * ページ
 * 
 */
let $page;
/**
 * ローディングオーバーレイ
 * 
 */
let $loadingOverlay;

$(function() {
    // ページを設定
    $page = $('#page');
    $loadingOverlay = $('#loadingOverlay');
});

/**
 * LIFF起動OSをチェックし結果を返却
 * 
 * @returns {boolean} チェック結果
 */
function checkOs() {
    // 起動OSを取得
    let os = liff.getOS();

    if (os === OS_WEB) {
        return false;
    } else {
        return true;
    }
}

/**
 * ローディングオーバーレイを表示
 * 
 */
function showLoadingOverlay() { $loadingOverlay.show(); }

/**
 * ローディングオーバーレイを非表示
 * 
 */
function hideLoadingOverlay() { $loadingOverlay.hide(); }

/**
 * LIFF初期化失敗時のアラートを表示
 * 
 */
function showAlertLiffInitFailure() { alert('Webページの表示に失敗しました'); }

/**
 * 起動OSが異なる場合のアラートを表示
 * 
 */
function showAlertMistakeOs() { alert('Webページを表示できません\nこのWebページはLINE上でのみ表示可能です'); }

/**
 * メッセージ送信失敗時のアラートを表示
 * 
 */
function showAlertSendMessages() { alert('メッセージの送信に失敗しました'); }