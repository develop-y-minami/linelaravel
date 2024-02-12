/**
 * FetchApi
 * 
 */
class FetchApi {
    /**
     * APIルート
     * 
     */
    static URL_ROOT_API = '/api';
    /**
     * STATUS 成功
     * 
     */
    static STATUS_SUCCESS = 'success';
    /**
     * STATUS 失敗
     * 
     */
    static STATUS_FAILURE = 'failure';
    /**
     * STATUS CODE バリデーションエラー
     * 
     */
    static STATUS_CODE_VALIDATION_EXCEPTION = 422;

    /**
     * HTTP Method GET
     * 
     * @param {string} url     URL
     * @param {object} headers HTTP Header
     * @returns {object}
     */
    static async get(url, headers = {}) {
        // response
        let response;
        
        // headerを設定
        headers['Content-Type'] = 'application/json';

        try {
            response = await fetch(
                FetchApi.URL_ROOT_API + '/' + url,
                {
                    method: 'GET',
                    headers: headers
                }
            );
            if (response.ok) {
                let data = await response.json();
                return {'status' : FetchApi.STATUS_SUCCESS, 'code' : response.status,  'data' : data};
            } else {
                let data = await response.json();
                return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status, 'error' : data.message};
            }
        } catch(error) {
            alert(error);
            showAlertLiffInitFailure();
            return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status,  'error' : error};
        }
    }

    /**
     * HTTP Method POST
     * 
     * @param {string} url     URL
     * @param {object} data    データ
     * @param {object} headers HTTP Header
     * @returns {object}
     */
    static async post(url, data = {}, headers = {}) {
        // response
        let response;

        // headerを設定
        headers['Content-Type'] = 'application/json';

        try {
            response = await fetch(
                FetchApi.URL_ROOT_API + '/' + url,
                {
                    method: 'POST',
                    headers: headers,
                    body: JSON.stringify(data)
                }
            );
            if (response.ok) {
                let data = await response.json();
                return {'status' : FetchApi.STATUS_SUCCESS, 'code' : response.status,  'data' : data};
            } else {
                if (response.status === FetchApi.STATUS_CODE_VALIDATION_EXCEPTION) {
                    // バリデーションエラー
                    let data = await response.json();
                    return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status,  'errors' : data.errors};
                } else {
                    let data = await response.json();
                    return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status, 'error' : data.message};
                }
            }
        } catch(error) {
            return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status,  'error' : error};
        }
    }

    /**
     * HTTP Method PUT
     * 
     * @param {string} url  URL
     * @param {object} data データ
     * @returns {object}
     */
    static async put(url, data = {}) {
        // response
        let response;

        try {
            response = await fetch(
                FetchApi.URL_ROOT_API + '/' + url,
                {
                    method: 'PUT',
                    headers: 
                    {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }
            );
            if (response.ok) {
                let data = await response.json();
                return {'status' : FetchApi.STATUS_SUCCESS, 'code' : response.status,  'data' : data};
            } else {
                if (response.status === FetchApi.STATUS_CODE_VALIDATION_EXCEPTION) {
                    // バリデーションエラー
                    let data = await response.json();
                    return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status,  'errors' : data.errors};
                } else {
                    let data = await response.json();
                    return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status, 'error' : data.message};
                }
            }
        } catch(error) {
            return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status,  'error' : error};
        }
    }

    /**
     * HTTP Method PATCH
     * 
     * @param {string} url     URL
     * @param {object} data    データ
     * @param {object} headers HTTP Header
     * @returns {object}
     */
    static async patch(url, data = {}, headers = {}) {
        let response;

        // headerを設定
        headers['Content-Type'] = 'application/json';

        try {
            response = await fetch(
                FetchApi.URL_ROOT_API + '/' + url,
                {
                    method: 'PATCH',
                    headers: headers,
                    body: JSON.stringify(data)
                }
            );
            if (response.ok) {
                let data = await response.json();
                return {'status' : FetchApi.STATUS_SUCCESS, 'code' : response.status,  'data' : data};
            } else {
                alert(url);
                if (response.status === FetchApi.STATUS_CODE_VALIDATION_EXCEPTION) {
                    // バリデーションエラー
                    let data = await response.json();
                    return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status,  'errors' : data.errors};
                } else {
                    let data = await response.json();
                    return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status, 'error' : data.message};
                }
            }
        } catch(error) {
            return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status,  'error' : error};
        }
    }

    /**
     * HTTP Method DELETE
     * 
     * @param {string} url  URL
     * @param {object} data データ
     * @returns {object}
     */
    static async delete(url, data = {}) {
        let response;

        try {
            response = await fetch(
                FetchApi.URL_ROOT_API + '/' + url,
                {
                    method: 'DELETE',
                    headers: 
                    {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }
            );
            if (response.ok) {
                let data = await response.json();
                return {'status' : FetchApi.STATUS_SUCCESS, 'code' : response.status,  'data' : data};
            } else {
                return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status,  'error' : response.statusText};
            }
        } catch(error) {
            return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status,  'error' : error};
        }
    }

}