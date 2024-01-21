/**
 * LineAccountTypeDoughnutChart
 * 
 */
class LineAccountTypeDoughnutChart extends DoughnutChart {
    /**
     * グラフタイトル
     * 
     */
    TITLE = 'トークタイプ';
    /**
     * 凡例
     * 
     */
    LABELS = ['１対１', 'グループ'];
    /**
     * 背景色
     * 
     */
    BACK_GROUND_COLOR = ["#cfffcf", "#d0d0ff", this.NO_DATA_COLOR];
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
    constructor(id = 'lineAccountTypeDoughnutChart') {
        super(id);
        this.chartObj.data.labels = ['１対１', 'グループ'];
        this.chartObj.data.datasets = [{
            backgroundColor: this.BACK_GROUND_COLOR,
            data: [null, null, 100]
        }];
        this.chartObj.options.plugins.title.text = this.TITLE;

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
                let oneToOneCount = 0;
                let group = 0;
                let noData = 0;

                for (let i = 0; i < lines.length; i++) {
                    if (lines[i].lineAccountType.id === LineAccountType.ONE_TO_ONE) {
                        oneToOneCount++;
                    } else if (lines[i].lineAccountType.id === LineAccountType.GROUP) {
                        group++;
                    } else {
                        noData++;
                    }
                }

                // グラフ描画用データ
                let data = [];

                // １対１
                if (oneToOneCount > 0) {
                    data.push((oneToOneCount / dataCount) * 100);
                } else {
                    data.push(null);
                }

                // グループ
                if (group > 0) {
                    data.push((group / dataCount) * 100);
                } else {
                    data.push(null);
                }

                // グループ
                if (noData > 0) {
                    data.push((noData / dataCount) * 100);
                } else {
                    data.push(null);
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