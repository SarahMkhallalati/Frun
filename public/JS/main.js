function search()
{
    query = document.getElementById('txtsearch').value;

    window.location.href = "/furniture/public/search?query="+query;
}
