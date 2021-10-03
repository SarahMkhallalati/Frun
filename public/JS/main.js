function search()
{
    query = document.getElementById('txtsearch').value;

    window.location.href = "/search?query="+query;
}
