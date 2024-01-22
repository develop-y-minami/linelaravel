/**
 * LineTransitionBarChart
 * 
 */
class LineTransitionBarChart extends DateBarChart {
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
     * @param {*} term 
     * @param {*} baseDate 
     */
    constructor({id = 'lineTransitionBarChart', term, baseDate}) {
        super(
            id,
            term,
            baseDate,
            'LINE数 推移',
            [],
            '増加数',
            ['#00ff002b'],
            ['#00ff00'],
            []
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

            // 日付を設定
            this.setDate();

            // Labelを設定
            this.setLabel();

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

                // グラフ描画用データ
                let data = [];
                let barData = Array(this.chartObj.data.labels.length);
                let lineData = Array(this.chartObj.data.labels.length);

                // データを初期化
                for (let i = 0; i < barData.length; i++) {
                    barData[i] = null;
                }

                for (let i = 0; i < lines.length; i++) {
                    // サービス提供者設定日を取得
                    let serviceProviderSettingDate = DateTimeUtil.formatDate(lines[i].serviceProviderSettingDate);

                    // 範囲内の日付を処理
                    if (this.startDate <= serviceProviderSettingDate && serviceProviderSettingDate <= this.endDate) {
                        // Dateクラスのインスタンスを生成
                        let targetDate = new Date(serviceProviderSettingDate);

                        // データ設定先インデックス
                        let index;

                        switch (this.term) {
                            case Term.YEAR :
                                let baseDate = new Date(this.baseDate);
                                let baseYear = baseDate.getFullYear();
                                let difference = baseYear - targetDate.getFullYear();
                                index = this.YEAR_RANGE - difference;
                                break;
                            case Term.MONTH :
                                index = targetDate.getMonth();
                                break;
                            case Term.DAY :
                                index = targetDate.getDate() - 1;
                                break;
                        }

                        // 棒グラフ描画用データに件数を加算
                        barData[index] = barData[index] + 1;
                    }
                }

                // 描画データを設定
                this.chartObj.data.datasets[0].data = barData;

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