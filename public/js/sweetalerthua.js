const swalWithBootstrapButtons = Swal.mixin({
    buttonsStyling: true
})

function deleteStore(e) {
    swalWithBootstrapButtons.fire({
        title: '削除しますか？',
        text: "本当にいいですか？",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'はい',
        cancelButtonText: 'いいえ'
    }).then((result) => {
        if (result.isConfirmed) {
            e.submit();
        }
    })
    return false;
}