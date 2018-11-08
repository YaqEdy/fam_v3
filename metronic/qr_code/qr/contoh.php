<div id="area"></div>
<script src="qart.js"></script>

<script>
    var QR_CONTENT = "This is the content of the QR Code";
    var QR_IMAGE = "hqdefault.jpg";
    var QR_FILTER = "color";
    var QR_CONTAINER = document.getElementById("area");
    new QArt({
        value: QR_CONTENT,
        imagePath: QR_IMAGE,
        filter: QR_FILTER
    }).make(QR_CONTAINER);
</script>