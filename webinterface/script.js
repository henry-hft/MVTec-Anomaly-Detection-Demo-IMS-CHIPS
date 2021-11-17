	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	
	function sleep(ms) {
		return new Promise(resolve => setTimeout(resolve, ms));
	}
	
	async function generate(device) {
        try {
            const response = await fetch('api.php?method=read&device=' + device, {
                method: 'get',
                headers: { 'content-type': 'text/plain' }
            })

            const newRecord = await response.text();
			var status = newRecord.charAt(0);
			//alert(status);
            if (status == "2") {
				var result = newRecord.substring(1);
				var n = result.split(" ");
				var url = n[n.length - 1];
				//alert(url);
				document.getElementById(device + "-image").src=url;
				//result = result.replace('/(?:http?|ftp):\/\/[\n\S]+/g', '');
				result = result.substring(0, result.lastIndexOf(" "));
                document.getElementById(device + "-result").innerHTML = '<h2>Result:</h2><br><pre>' + result + '</pre>';
				document.getElementById(device).removeAttribute("hidden");
            } else {
					await sleep(5000);
					generate(device)
            }

        } catch (err) {
            console.error(err)
        }
    }