<!-- TinyMCE -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  tinymce.init({
    selector: 'textarea.tinymce-editor',
    height: 500,

    // Empêcher l’encodage en entités (&eacute;, &nbsp;)
    entity_encoding: 'raw',
    convert_urls: false,
    remove_script_host: true,
    forced_root_block: 'p',

    plugins: [
      'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
      'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
      'insertdatetime', 'media', 'table', 'help', 'wordcount', 'paste'
    ],

    // Sélecteur de blocs : H2/H3/H4 visibles et faciles à appliquer
    block_formats: 'Paragraphe=p; Titre 1=h1; Titre 2=h2; Titre 3=h3; Titre 4=h4',

    toolbar: 'undo redo | blocks | bold italic forecolor | ' +
             'alignleft aligncenter alignright alignjustify | ' +
             'bullist numlist outdent indent | removeformat | code | help',

    content_style:
      'body{font-family:-apple-system,BlinkMacSystemFont,San Francisco,Segoe UI,Roboto,Helvetica Neue,sans-serif;font-size:14px;line-height:1.6;}',
    branding: false,
    promotion: false,
    menubar: false,
    statusbar: false,
    resize: false,
    content_css: false,
    skin: 'oxide',
    icons: 'default',

    setup(editor) {
      // Sauvegarde auto dans le <textarea>
      editor.on('change', () => editor.save());

      // Nettoyage à la sortie : remplace NBSP et trim après <h*>
      editor.on('GetContent', (e) => {
        if (typeof e.content === 'string') {
          e.content = e.content
            .replace(/&nbsp;/g, ' ')
            .replace(/(<h[1-6][^>]*>)\s+/gi, '$1'); // espace(s) après <h2>...
        }
      });
    },

    // Collage : on supprime les NBSP à l’import
    paste_as_text: false,
    paste_postprocess: (_plugin, args) => {
      if (args.node && typeof args.node.innerHTML === 'string') {
        args.node.innerHTML = args.node.innerHTML
          .replace(/&nbsp;/g, ' ')
          .replace(/(<h[1-6][^>]*>)\s+/gi, '$1');
      }
    }
  });
});
</script>