$(function() {
    /**
     * ID
     * 
     */
    const lineNoticeGridId = '#lineNoticeGrid';

    /**
     * 通知リストグリッドカラム定義
     * 
     */
    const columnDefs = [
        {
            field: 'userId',
            headerName: '担当者',
        },
        {
            field: 'noticeDateTime',
            headerName: '通知日時',
        },
        {
            field: 'lineDisplayName',
            headerName: 'トーク相手/グループ',
        },
        {
            field: 'noticeType',
            headerName: '通知区分',
        },
        {
            field: 'content',
            headerName: '内容',
            flex: 1,
        },
    ]

    /**
     * 通知リストグリッド
     * 
     */
    let gridOptions = {};

    /**
     * 通知リストグリッド Api
     * 
     */
    let gridApi;

    try {
        // 初期化処理を実行
        init();

    } catch(error) {
        console.error(error);
    }

    /**
     * 初期化処理
     * 
     */
    function init() {
        try {
            // 通知リストグリッドを初期化
            initLineNoticeGrid();
    
        } catch(error) {
            throw error;
        }
    }

    function initLineNoticeGrid() {
        

        let rowData = [
            {
                userId: 'AAA',
                noticeDateTime: '2023年11月12日 23時04分',
                lineDisplayName: '南　優毅',
                noticeType: '友達追加',
                content: '友達追加されました',
            },
            {
                userId: 'AAA',
                noticeDateTime: '2023年11月12日 23時04分',
                lineDisplayName: '南　優毅',
                noticeType: '友達追加',
                content: '友達追加されました',
            },
            {
                userId: 'AAA',
                noticeDateTime: '2023年11月12日 23時04分',
                lineDisplayName: '南　優毅',
                noticeType: '友達追加',
                content: '友達追加されました',
            },
        ];

        // カラムを設定
        gridOptions.columnDefs = columnDefs;

        gridOptions.rowData = rowData;

        gridOptions.headerHeight = 33;
        gridOptions.rowHeight = 33;

        // グリッド生成
        let gridDiv = document.querySelector(lineNoticeGridId);
        gridApi = agGrid.createGrid(gridDiv, gridOptions);
    }
});