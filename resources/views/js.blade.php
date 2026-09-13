


<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.0/ckeditor5.css" />





    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.3.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.3.0/"
            }
        }
    </script>

    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph,
            GeneralHtmlSupport,
            SourceEditing,
            Link,
            Image,
            ImageToolbar,
            ImageCaption,
            ImageUpload,
            ImageResizeEditing,
            ImageResizeHandles,
            Heading,
            List,
            BlockQuote,
            Highlight,
            MediaEmbed,
            Code,
            Table,
            DecoupledEditor,
            TableToolbar,
            Strikethrough,
            HorizontalLine,
            ShowBlocks,
            Alignment,
            SimpleUploadAdapter,
            ImageStyle
        } from 'ckeditor5';

        // Get all elements with the class 'editor'
        const editors = document.querySelectorAll('.editor');

        // Create a CKEditor instance for each editor
        editors.forEach((editorElement) => {
            ClassicEditor
                .create(editorElement, {
                    plugins: [
                        Essentials,
                        Bold,
                        Heading,
                        Italic,
                        ImageResizeEditing,
                        ImageResizeHandles,
                        Font,
                        Paragraph,
                        GeneralHtmlSupport,
                        SourceEditing,
                        Link,
                        Image,
                        ImageToolbar,
                        ImageCaption,
                        ImageUpload,
                        SimpleUploadAdapter,
                        DecoupledEditor,
                        List,
                        MediaEmbed,
                        BlockQuote,
                        Highlight,
                        ShowBlocks,
                        Table,
                        TableToolbar,
                        Code,
                        Strikethrough,
                        Alignment,
                        HorizontalLine,
                        ImageStyle
                    ],
                    toolbar: [
                        'undo', 'redo', '|',
                        'heading', 'paragraph', 'showBlocks', 'insertTable',
                        'bold', 'italic', 'strikethrough', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                        'link', 'imageUpload', '|',
                        'bulletedList', 'numberedList', '|',
                        'blockQuote', 'horizontalLine', '|',
                        'highlight', 'code', '|',
                        'sourceEditing'
                    ],
                    image: {
                    toolbar: [
                        'imageStyle:alignLeft', 
                        'imageStyle:alignCenter', 
                        'imageStyle:alignRight', 
                        '|', 
                        'toggleImageCaption', 
                        'linkImage'
                    ],
                    styles: [
                        { name: 'alignLeft', title: 'Align Left', icon: 'left', className: 'image-style-align-left' },
                        { name: 'alignCenter', title: 'Align Center', icon: 'center', className: 'image-style-align-center' },
                        { name: 'alignRight', title: 'Align Right', icon: 'right', className: 'image-style-align-right' }
                    ],
                    defaultStyle: 'alignLeft'
                },
                    simpleUpload: {
                        uploadUrl: '{{ route('admin.ckeditor.upload') }}', // Your upload URL
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token if needed
                        }
                    },
                    htmlSupport: {
                        allow: [
                            {
                                name: /.*/,
                                attributes: true,
                                classes: true,
                                styles: true
                            }
                        ]
                    },
                    table: {
                        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                    }
                })
                .then(editor => {
                    console.log('Editor was initialized', editor);
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
