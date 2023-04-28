const updateEmpresConfig = async (key, value, validate = 0) => {
    const formData = new FormData();
    formData.append('funcion', 'updateEmpresConfig');

    formData.append('key', key);
    formData.append('value', value);
    formData.append('validate', validate);

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'empres-config.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);

        return data;

    } catch (error) {
        console.log(error);
    }
}

const updateRecargo = async (id, value) => {
    const formData = new FormData();
    formData.append('funcion', 'updateRecargo');

    formData.append('id', id);
    formData.append('value', value);

    try {
        const res = await fetch(URL_APP + 'php/backend/' + 'forpag.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.text();
        console.log(data);

        return data;

    } catch (error) {
        console.log(error);
    }
}