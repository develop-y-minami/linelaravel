/**
 * LineAccountStatusDoughnutChart
 * 
 */
class LineAccountStatusDoughnutChart extends DoughnutChart {
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
    constructor(id = 'lineAccountStatusDoughnutChart') {
        super(
            id,
            '状態',
            ['友達/参加中', 'ブロック/退出中'],
            ['#00ff002b', '#ff00002e', '#f1f1f1'],
            ['#00ff00', '#ff0000', '#f1f1f1'],
            [null, null, 100]
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
                let validCount = 0;
                let noValidCount = 0;

                for (let i = 0; i < lines.length; i++) {
                    if (LineAccountStatus.isValid(lines[i].lineAccountStatus.id)) {
                        validCount++;
                    } else {
                        noValidCount++;
                    }
                }

                // グラフ描画用データ
                let data = [];

                if (dataCount === 0) {
                    data.push(null);
                    data.push(null);
                    data.push(100);
                } else {
                    // 友達/参加中
                    if (validCount > 0) {
                        data.push((validCount / dataCount) * 100);
                    } else {
                        data.push(null);
                    }

                    // ブロック/退出中
                    if (noValidCount > 0) {
                        data.push((noValidCount / dataCount) * 100);
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