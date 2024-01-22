/**
 * LineUserDoughnutChart
 * 
 */
class LineUserDoughnutChart extends DoughnutChart {
    /**
     * サービス提供者ID
     * 
     */
    $serviceProviderId;
    /**
     * 担当者ID
     * 
     */
    $userId;
    /**
     * サービス提供者ID
     * 
     */
    serviceProviderId;
    /**
     * 担当者ID
     * 
     */
    userId;

    /**
     * constructor
     * 
     * @param {string} id ID値
     */
    constructor(id = 'lineUserDoughnutChart') {
        super(
            id,
            'ユーザー登録',
            ['登録済', '未登録'],
            ['#9300ff29', '#f1f1f1'],
            ['#9300ff', '#f1f1f1'],
            [null, 100]
        );

        // サービス提供者ID
        this.$serviceProviderId = $('#' + id + 'ServiceProviderId');
        this.serviceProviderId = null;
        if (this.$serviceProviderId.val() !== '0') {
            this.serviceProviderId = Number(this.$serviceProviderId.val());
        }

        // 担当者ID
        this.$userId = $('#' + id + 'UserId');
        this.userId = null;
        if (this.$userId.val() !== '0') {
            this.userId = Number(this.$userId.val());
        }
    }

    /**
     * グラフ描画データを設定
     * 
     */
    async setData() {
        try {
            // オーバーレイを表示
            this.$overlay.show();

            // API経由で通知情報を取得
            let result = await LineApi.lines({serviceProviderId : this.serviceProviderId, userId : this.userId});

            if (result.status == FetchApi.STATUS_SUCCESS) {
                // 取得データを抽出
                let lines = result.data.lines;

                // データ数を設定
                let dataCount = lines.length;

                // データ数
                let existCount = 0;
                let noExistCount = 0;

                for (let i = 0; i < lines.length; i++) {
                    if (lines[i].lineUser.id > 0) {
                        existCount++;
                    } else {
                        noExistCount++;
                    }
                }

                // グラフ描画用データ
                let data = [];

                if (dataCount === 0) {
                    data.push(null);
                    data.push(100);
                } else {
                    // 登録済
                    if (existCount > 0) {
                        data.push((existCount / dataCount) * 100);
                    } else {
                        data.push(null);
                    }

                    // 未登録
                    if (noExistCount > 0) {
                        data.push((noExistCount / dataCount) * 100);
                    } else {
                        data.push(null);
                    }
                }

                // 描画データを設定
                this.chartObj.data.datasets[0].data = data;

                // グラフを描画
                this.create();
            }

            // オーバーレイを非表示
            this.$overlay.hide();
        } catch(error) {
            throw error;
        }
    }
}