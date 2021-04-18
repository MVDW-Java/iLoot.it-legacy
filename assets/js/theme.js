var button = document.getElementById('theme-button')
if(button.clicked == true){
localStorage.setItem('theme', 'dark')
console.log(`1`)
} else {
console.log(`2`)
localStorage.setItem('theme', 'light')
}