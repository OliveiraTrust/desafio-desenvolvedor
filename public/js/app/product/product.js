axios.defaults.headers.post['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
openModalCreateProduct = function () {
    resetModalProduct()
    jQuery('#linkEditorModal').modal('show');
}
pullDataProduct = function (id) {
    jQuery('#linkEditorModal').modal('show');
    axios.get('/products/' + id)
        .then(function (response) {
            document.getElementById('product_id').value = id
            document.querySelector('input[name="name"]').value = response.data.name
            document.querySelector('input[name="description"]').value = response.data.description
            document.querySelector('input[name="amount"]').value = response.data.amount
            id = ''
        })
        .catch(function (error) {
            console.log(error);
            id = ''
        });
};

saveOrUpdateProduct = function () {
    if (document.getElementById('product_id').value > 0) {
        return updateDataProduct()
    } else {
        return saveDataProduct()
    }
}

resetModalProduct = function () {
    document.querySelector('input[name="name"]').value = ""
    document.querySelector('input[name="description"]').value = ""
    document.querySelector('input[name="amount"]').value = ""
}
saveDataProduct = function () {
    let name = document.querySelector('input[name="name"]').value
    let description = document.querySelector('input[name="description"]').value
    let amount = document.querySelector('input[name="amount"]').value
    axios.post('/product', {
        name,description,amount
        })
        .then(function (response) {
            jQuery('#modalFormData').trigger("reset");
            jQuery('#linkEditorModal').modal('hide')
            if (response.status == '200') {
                window.location.href = "/product"
            }
        })
        .catch(function (error) {
            const er = document.querySelector('#errors')
            er.classList.remove("hidden")
            var li = document.getElementById('err')
            li.innerHTML = error.response.data.message
        });
}
updateDataProduct = function () {
    let id = document.getElementById('product_id').value
    let name = document.querySelector('input[name="name"]').value
    let description = document.querySelector('input[name="description"]').value
    let amount = document.querySelector('input[name="amount"]').value
    axios.put('/product/' + id, {
        name,description,amount
        })
        .then(function (response) {
            jQuery('#modalFormData').trigger("reset");
            jQuery('#linkEditorModal').modal('hide')
            if (response.status == '200') {
                window.location.href = "/product"
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}

deleteDataProduct = function(id) {
    axios.delete('/product/del/' + id)
        .then(function (response) {
            id = ''
            if (response.status == '200') {
                window.location.href = "/product"
            }
        })
        .catch(function (error) {
            console.log(error);
            id = ''
        });
}
