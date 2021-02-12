<script defer>
    // Example POST method implementation:
    async function postData(url = '', data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
    method: 'POST', // *GET, POST, PUT, DELETE, etc.
    mode: 'cors', // no-cors, *cors, same-origin
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    credentials: 'same-origin', // include, *same-origin, omit
    headers: {
        'Content-Type': 'application/json',
        //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //jQuery
        'X-CSRF-TOKEN': document.getElementsByTagName("meta")[2].content //Vanilla JS
        // 'Content-Type': 'application/x-www-form-urlencoded',
    },
    redirect: 'follow', // manual, *follow, error
    referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    body: JSON.stringify(data) // body data type must match "Content-Type" header
    });
    return response.json(); // parses JSON response into native JavaScript objects
    }

    
        document.getElementById("searchDonor").addEventListener("click", function(event){
            event.preventDefault()
            postData('{{ route("test")}}', { "qrCode" : document.getElementById('qrCode').value })
            .then(data => {
                console.log(data); // JSON data parsed by `data.json()` call
            });
        });
    //console.log(document.getElementsByTagName("meta")[2].content);
</script>