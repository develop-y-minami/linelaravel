/**
 * FetchApi
 * 
 */
class FetchApi {
    /**
     * APIルート
     * 
     */
    static URL_ROOT_API = 'http://127.0.0.1:8000/api';
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
     * @param {string} url - URL
     * @returns {object}
     */
    static async get(url) {
        let response;
        try {
            response = await fetch(FetchApi.URL_ROOT_API + '/' + url);
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

    /**
     * HTTP Method POST
     * 
     * @param {string} url  URL
     * @param {object} data データ
     * @returns {object}
     */
    static async post(url, data = {}) {
        let response;
        try {
            response = await fetch(
                FetchApi.URL_ROOT_API + '/' + url,
                {
                    method: 'POST',
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
                    return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status, 'error' : response.statusText};
                }
            }
        } catch(error) {
            return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status,  'error' : error};
        }
    }

    /**
     * HTTP Method PATCH
     * 
     * @param {string} url  URL
     * @param {object} data データ
     * @returns {object}
     */
    static async patch(url, data = {}) {
        let response;
        try {
            response = await fetch(
                FetchApi.URL_ROOT_API + '/' + url,
                {
                    method: 'PATCH',
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
                    return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status, 'error' : response.statusText};
                }
            }
        } catch(error) {
            return {'status' : FetchApi.STATUS_FAILURE, 'code' : response.status,  'error' : error};
        }
    }

    /**
     * HTTP Method DELETE
     * 
     * @param {string} url - URL
     * @returns {object}
     */
    static async delete(url) {
        let response;
        try {
            response = await fetch(FetchApi.URL_ROOT_API + '/' + url, { method: 'DELETE' });
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