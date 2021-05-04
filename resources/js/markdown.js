import Editor from '@toast-ui/editor';
import 'codemirror/lib/codemirror.css'; // Editor's Dependency Style
import '@toast-ui/editor/dist/toastui-editor.css'; // Editor's Style
import 'highlight.js/styles/github.css';
import codeSyntaxHighlight from '@toast-ui/editor-plugin-code-syntax-highlight';
import hljs from 'highlight.js';
const markdown = {};

markdown.Editor = Editor;
markdown.codeSyntaxHighlight = codeSyntaxHighlight;
markdown.hljs = hljs;
export default markdown;