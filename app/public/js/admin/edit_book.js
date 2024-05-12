window.Admin = {
    csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

    deleteImage(bookName, filePath) {
        fetch(`/edit_book/images?name=${encodeURIComponent(bookName)}&file_path=${encodeURIComponent(filePath)}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken,
            },
        })
        .then(r => {
            if ( r.status === 204 ) {
                this.removeGuiImage(bookName, filePath)
            }
        })
    },

    removeGuiImage(name, path) {
        document.getElementById(`${name}-${path}`).remove()
    }
}
