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
    BACK_GROUND_COLOR = ['#00ff002b', '#0000ff17', this.NO_DATA_COLOR];
    /**
     * 線色
     * 
     */
    BORDER_COLOR = ['#00ff00', '#009fff', this.NO_DATA_COLOR];
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
        super(
            id,
            'トークタイプ',
            ['１対１', 'グループ'],
            ['#00ff002b', '#0000ff17', '#f1f1f1'],
            ['#00ff00', '#009fff', '#f1f1f1'],
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
                let oneToOneCount = 0;
                let group = 0;

                for (let i = 0; i < lines.length; i++) {
                    if (lines[i].lineAccountType.id === LineAccountType.ONE_TO_ONE) {
                        oneToOneCount++;
                    } else {
                        group++;
                    }
                }

                // グラフ描画用データ
                let data = [];

                if (dataCount === 0) {
                    data.push(null);
                    data.push(null);
                    data.push(100);
                } else {
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