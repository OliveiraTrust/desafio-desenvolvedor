axios.defaults.headers.post['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
openModalCreateOrder = function () {
    resetModalOrder()
    jQuery('#linkEditorModal').modal('show');
}
pullDataOrder = function (id) {
    jQuery('#linkEditorModal').modal('show');
    axios.get('/orders/' + id)
        .then(function (response) {
            document.getElementById('order_id').value = id
            document.querySelector('input[name="description"]').value = response.data.description
            document.getElementById('select').value = response.data.active
            id = ''
        })
        .catch(function (error) {
            console.log(error);
            id = ''
        });
};

saveOrUpdateOrder = function () {
    if (document.getElementById('order_id').value > 0) {
        return updateDataOrder()
    } else {
        return saveDataOrder()
    }
}

resetModalOrder = function () {
    document.querySelector('input[name="description"]').value = ""
    document.getElementById('select').value = ""
    
}
saveDataOrder = function () {
    let description = document.querySelector('input[name="description"]').value
    let active = document.getElementById('select').value
    axios.post('/order', {
        description, active
        })
        .then(function (response) {
            jQuery('#modalFormData').trigger("reset");
            jQuery('#linkEditorModal').modal('hide')
            if (response.status == '200') {
                window.location.href = "/order"
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}
updateDataOrder = function () {
    let id = document.getElementById('order_id').value
    let description = document.querySelector('input[name="description"]').value
    let active = document.getElementById('select').value
    axios.put('/order/' + id, {
        description,active
        })
        .then(function (response) {
            jQuery('#modalFormData').trigger("reset");
            jQuery('#linkEditorModal').modal('hide')
            if (response.status == '200') {
                window.location.href = "/order"
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}

deleteDataOrder = function(id) {
    axios.delete('/order/del/' + id)
        .then(function (response) {
            id = ''
            if (response.status == '200') {
                window.location.href = "/order"
            }
        })
        .catch(function (error) {
            console.log(error);
            id = ''
        });
}
