new DrawingBoard.Board('paint', {
    controls: [
        'Color',
        {
            Size: {
                type: 'range'
            }
        },
        'DrawingMode',
        'Navigation',
        'Download'
    ],
    webStorage: 'local'
});