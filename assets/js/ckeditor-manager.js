const ckEditorManager = () => {
    ClassicEditor
        // Initialisation ckeditor
        .create(document.querySelector('#editor'))
        .then(editor => {
              editor.sourceElement.parentElement.addEventListener('submit', (e) => {
                  e.preventDefault();
                  e.target.querySelector('.fill-me').value = editor.getData();
                  e.target.submit();
              });
        })
    ;
};

module.exports = ckEditorManager;
