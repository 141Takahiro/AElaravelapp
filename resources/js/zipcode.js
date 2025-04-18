/*API利用の為に追加*/
document.addEventListener('DOMContentLoaded', function () {
    const zipcodeInput = document.getElementById('zipcode');
    
    zipcodeInput.addEventListener('input', function () {
        const zipcode = this.value.replace('-', '');
        if (zipcode.length === 7) {
            fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${zipcode}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('通信に失敗しました。');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.results) {
                        const addressData = data.results[0];
                        const fullAddress = `${addressData.address1}${addressData.address2}${addressData.address3}`;
                        const addressField = document.getElementById('address');
                        if (addressField) {
                            addressField.value = fullAddress;
                        }
                    } else {
                        alert('該当する住所が見つかりませんでした。');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('通信に失敗しました。もう一度お試しください。');
                });
        }
    }); 
});