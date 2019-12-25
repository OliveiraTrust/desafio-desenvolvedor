axios.defaults.headers.post['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
openModalCreateClient = function () {
    resetModalClient()
    jQuery('#linkEditorModal').modal('show');
}
pullDataClient = function (id) {
    jQuery('#linkEditorModal').modal('show');
    axios.get('/clients/' + id)
        .then(function (response) {
            document.getElementById('user_id').value = id
            document.querySelector('input[name="name"]').value = response.data.name
            document.querySelector('input[name="email"]').value = response.data.email
            document.querySelector('input[name="phone"]').value = response.data.phone
            document.querySelector('input[name="address"]').value = response.data.address
            document.querySelector('input[name="number"]').value = response.data.number
            id = ''
        })
        .catch(function (error) {
            console.log(error);
            id = ''
        });
};

saveOrUpdateClient = function () {
    if (document.getElementById('user_id').value > 0) {
        return updateDataClient()
    } else {
        return saveDataClient()
    }
}

resetModalClient = function () {
    document.querySelector('input[name="name"]').value = ""
    document.querySelector('input[name="email"]').value = ""
    document.querySelector('input[name="address"]').value = ""
    document.querySelector('input[name="phone"]').value = ""
    document.querySelector('input[name="number"]').value = ""
}
saveDataClient = function () {
    let name = document.querySelector('input[name="name"]').value
    let email = document.querySelector('input[name="email"]').value
    let phone = document.querySelector('input[name="phone"]').value
    let address = document.querySelector('input[name="address"]').value
    let number = document.querySelector('input[name="number"]').value
    axios.post('/client', {
        name,email,phone,address,number
        })
        .then(function (response) {
            jQuery('#modalFormData').trigger("reset");
            jQuery('#linkEditorModal').modal('hide')
            if (response.status == '200') {
                window.location.href = "/"
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}
updateDataClient = function () {
    let id = document.getElementById('user_id').value
    let name = document.querySelector('input[name="name"]').value
    let email = document.querySelector('input[name="email"]').value
    let phone = document.querySelector('input[name="phone"]').value
    let address = document.querySelector('input[name="address"]').value
    let number = document.querySelector('input[name="number"]').value
    axios.put('/client/' + id, {
        name,email,phone,address,number
        })
        .then(function (response) {
            jQuery('#modalFormData').trigger("reset");
            jQuery('#linkEditorModal').modal('hide')
            if (response.status == '200') {
                window.location.href = "/"
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}

deleteDataClient = function(id) {
    axios.delete('/client/del/' + id)
        .then(function (response) {
            id = ''
            if (response.status == '200') {
                window.location.href = "/"
            }
        })
        .catch(function (error) {
            console.log(error);
            id = ''
        });
}
