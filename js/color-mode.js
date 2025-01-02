var cm = window.localStorage.getItem('colorMode');
if(cm == null || cm == '')
{
    cm = 'light-mode';
}
document.querySelector('body').classList.add(cm);
