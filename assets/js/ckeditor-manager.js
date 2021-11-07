const ckEditorManager = () => {
    ClassicEditor
        // Initialisation ckeditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            console.log(document.querySelector('form'))
              document.querySelector('form').addEventListener('submit', (e) => {
                  e.preventDefault();
                  e.target.querySelector('.fill-me').value = editor.getData();
                  e.target.submit();
              });
        })
    ;
};

module.exports = ckEditorManager;
