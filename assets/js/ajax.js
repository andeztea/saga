var page = "media.php";

function autorefresh(page) {
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.open("GET", page, true);
        req.send(null);
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLDOM");
        if (req) {
            req.open("GET", page, true);
            req.send(null);
        }
    }
    setTimeout("autorefresh(page)", 10);
}