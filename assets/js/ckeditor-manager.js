const ckEditorManager = () => {
    ClassicEditor
        // Initialisation ckeditor
        .create(document.querySelector('#editor'), {
            heading: {
                options: [{
                    model: 'paragraph',
                    title: 'Paragraphe',
                    class: 'ck-heading-paragraph'
                },
                {
                    model: 'heading3',
                    title: 'Propriété',
                    class: 'ck-heading-heading3',
                    view: 'h3'
                }]
            }
        })
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
