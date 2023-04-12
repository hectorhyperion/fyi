// Generic Ajax GET function
function goGet(url) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "GET",
            url,
            statusCode: {
                200: (res) => {
                    if(res.status != undefined) {
                        res.status == 200 ? resolve(res) : reject(res)
                    }
                    else {
                        resolve(res)
                    }
                },
                500: (err) => {
                    err.status = 500;
                    reject(err);
                },
                404: (err) => {
                    err.status = 404;
                    reject(err);
                },
                419: (err) => {
                    err.status = 419;
                    reject(err);
                },
            },
        })
    });
}

// Generic Ajax POST function
function goPost(url, data) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "POST",
            url,
            data,
            processData: false,
            contentType: false,
            statusCode: {
                200: (res) => {
                    if(res.status != undefined) {
                        res.status == 200 ? resolve(res) : reject(res)
                    }
                    else {
                        resolve(res)
                    }
                },
                500: (err) => {
                    err.status = 500;
                    reject(err);
                },
                404: (err) => {
                    err.status = 404;
                    reject(err);
                },
                419: (err) => {
                    err.status = 419;
                    reject(err);
                },
            },
        })
    });
}

// Handle form error
function handleFormRes(res, form = false) {
    switch (res.status) {
        case 200:
            break;
        case 400:
            errors = res.message;

            if (typeof errors === "object") {
                for (const [key, value] of Object.entries(errors)) {
                    e = document.getElementById(key);
                    e.innerHTML = "";
                    [...value].forEach((m) => {
                        e.innerHTML += `<p>${m}</p>`;
                    });
                }
            } else {
                if (form) {
                    $("#" + form).html(errors);
                    $("#" + form).removeClass("d-none");
                } else {
                    showAlert(false, errors);
                }
            }
            break;

        default:
            if (form) {
                $("#" + form).text("Oops! Something's not right. Try Again");
                $("#" + form).removeClass("d-none");
            } else {
                showAlert(false, "Oops! Something's not right. Try Again");
            }
            break;
    }
}

// Toggle Spinner
let btnDis = false;

function spin(id) {
    btnDis = btnDis ? false : true;
    $(`#${id}-txt`).toggle();
    $(`#${id}-spinner`).toggle();

    btnDis
        ? $(`#${id}-btn`).attr("disabled", true)
        : $(`#${id}-btn`).removeAttr("disabled");
}

// Turn off Form Errors
function offError(form = false) {
    $(".error-message").html("");
    form ? $("#" + form).addClass("d-none") : null;
}

// Check response
function trueRes(res) {
    return res.status == 200 || res.status == undefined ? true : false;
}

// Show Alert
function showAlert(status, message) {
    if (!status) {
        $("#alert-error").html(message);
        $("#alert-error").removeClass("d-none");

        setTimeout(() => {
            $("#alert-error").addClass("d-none");
            $("#alert-error").html("");
        }, 4000);
    } else {
        $("#alert-success").html(message);
        $("#alert-success").removeClass("d-none");

        setTimeout(() => {
            $("#alert-success").addClass("d-none");
            $("#alert-success").html("");
        }, 4000);
    }
}
