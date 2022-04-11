const rulesBtn = document.getElementById('rules-btn');
const closeBtn = document.getElementById('close-btn');
const rules = document.getElementById('rules');
const startbtn= document.getElementById('start');
const restartbtn= document.getElementById('restart');
const cards = document.querySelectorAll('.memory-card');

rulesBtn.addEventListener('click', () => rules.classList.add('show'));
closeBtn.addEventListener('click', () => rules.classList.remove('show'));

  let hasFlippedCard = false;
  let lockBoard = false;
  let firstCard, secondCard;
  let moves=0;
  let count=0;
  function increaseMoves(){
	moves++;
	document.getElementById('moves').value=moves;
  }
  
function move(){
	  document.location.href="Scoresheet.php?game=Memory Game&score=" + moves;
  }
  function flipCard() {
    if (lockBoard) return;
    if (this === firstCard) return;
	
    this.classList.add('flip');
	
    if (!hasFlippedCard) {
      hasFlippedCard = true;
      firstCard = this;
      return;
    }

    secondCard = this;

    checkForMatch();
	
  }

  function checkForMatch() {
    let isMatch = firstCard.dataset.framework === secondCard.dataset.framework;
    isMatch ? disableCards() : unflipCards();
  }

  function disableCards() {
    firstCard.removeEventListener('click', flipCard);
    secondCard.removeEventListener('click', flipCard);
    resetBoard();
	count++;
	if(count==6){ document.getElementById('id1').style.display='block'; count=0;const time=setTimeout(move,3000);}
	
  }
  
  function unflipCards() {
	lockBoard=true;
    setTimeout(() => {
      firstCard.classList.remove('flip');
      secondCard.classList.remove('flip');
      resetBoard();
    },1000);
  }

  function resetBoard() {
    [hasFlippedCard, lockBoard] = [false, false];
    [firstCard, secondCard] = [null, null];
  }

restartbtn.addEventListener('click', () => (function shuffle() {
   cards.forEach(card => {
     let ramdomPos = Math.floor(Math.random() * 12);
     card.style.order = ramdomPos;});
 })());
startbtn.addEventListener('click', () => (function shuffle() {
   cards.forEach(card => {
     let ramdomPos = Math.floor(Math.random() * 12);
     card.style.order = ramdomPos;});
 })());

startbtn.addEventListener('click', () => cards.forEach(card => card.addEventListener('click', flipCard)));
restartbtn.addEventListener('click', () => cards.forEach(card => card.classList.remove('flip'))); 
restartbtn.addEventListener('click', () => cards.forEach(card => card.addEventListener('click', flipCard)));
restartbtn.addEventListener('click', () => (function setMoves(){document.getElementById('moves').value=0;moves=0;})());
startbtn.addEventListener('click', () => (function setMoves(){document.getElementById('moves').value=0;moves=0;})());
cards.forEach(card => card.addEventListener('click', increaseMoves));