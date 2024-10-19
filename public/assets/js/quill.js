


var toolbarOptions = [
    [{ 'header': [1, 2, 3, false] }],
    ['bold', 'italic', 'underline', 'strike'],        // Text formatting
    [{ 'list': 'ordered' }, { 'list': 'bullet' }],      // Lists
    [{ 'script': 'sub' }, { 'script': 'super' }],       // Subscript/superscript
    [{ 'indent': '-1' }, { 'indent': '+1' }],           // Indent
    [{ 'direction': 'rtl' }],                          // Text direction
    [{ 'size': ['small', false, 'large', 'huge'] }],   // Font size
    [{ 'color': [] }, { 'background': [] }],           // Text color/background
    [{ 'font': [] }],
    [{ 'align': [] }],
    ['link', 'image', 'video'],                        // Links, images, and videos
    ['clean']                                      // Remove formatting
];

var quill = new Quill('#quillEditor', {
    theme: 'snow',
    modules: {
        toolbar: toolbarOptions
    }
});