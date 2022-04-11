const grid = document.querySelector('.grid')
const resultDisplay = document.querySelector('.results')
const rulesBtn = document.getElementById('rules-btn');
const closeBtn = document.getElementById('close-btn');
const rules = document.getElementById('rules');
rulesBtn.addEventListener('click', () => rules.classList.add('show'));
closeBtn.addEventListener('click', () => rules.classList.remove('show'));
let currentShooterIndex = 202 //default location of the shooter
let width = 15  //used in the function moveShooter
let direction = 1   //the direction in which the invaders move
let invaderID
let movingRight = true //defines the instance where the invaders are moving to the right
let aliensRemoved = []
let results = 0     //score of the player

//creates small squares inside the grid
for (let i=0; i<225; i++)
{
    const square = document.createElement('div')
    grid.appendChild(square)
}

// creates an array of squares from the divs inside the grid
const squares = Array.from(document.querySelectorAll('.grid div'))

// variable to declare the indexes where the aliens should be in
const alienInvaders = [ 0,1,2,3,4,5,6,7,8,9,15,16,17,18,19,20,21,22,23,24,30,31,32,33,34,35,36,37,38,39]

// function to place the invaders in the squares
function place()
{
    for(let i=0; i < alienInvaders.length; i++)
    {
        if (!aliensRemoved.includes(i))     // when the aliens are shot with the laser, the destroyed alien cannot be placed/drawn again. therefore this if condition excludes the destroyed aliens.
        {
            squares[alienInvaders[i]].classList.add('invader')
        }
    }
}

// calling the place function to place the alien invaders
place()

// function to remove the alien invaders
function remove()
{
    for(let i=0; i < alienInvaders.length; i++)
    {
        squares[alienInvaders[i]].classList.remove('invader')
    }
}

// placing the shooter
squares[currentShooterIndex].classList.add('shooter')

// function to move the shooter across horizontally
function moveShooter(e)
{
    squares[currentShooterIndex].classList.remove('shooter')
    switch(e.key)
    {
        case 'ArrowLeft':
            if (currentShooterIndex % width !== 0)
            currentShooterIndex -=1
            break
        case 'ArrowRight':
            if (currentShooterIndex % width < width-1)
            currentShooterIndex +=1
            break
    }
    squares[currentShooterIndex].classList.add('shooter')
}

// calling the moveShooter function
document.addEventListener('keydown', moveShooter)

// function to move the alien invaders
function moveInvaders()
{
    //defining the left and right edges of the grid for the invaders
    const leftEdge = alienInvaders[0] % width === 0 
    const rightEdge = alienInvaders[alienInvaders.length - 1] % width === width - 1

    //calling the alien removing 'remove' function
    remove()

    // changing the direction of the invaders at the right edge
    if (rightEdge && movingRight)
    {
        for (let i = 0; i < alienInvaders.length; i++)
        {
            alienInvaders[i] += width + 1
            direction = -1
            movingRight = false
        }
    }

    //  changin the direction of the invaders at the left edge
    if (leftEdge && !movingRight)
    {
        for (let i = 0; i < alienInvaders.length; i++)
        {
            alienInvaders[i] += width - 1
            direction = 1
            movingRight = true
        }
    }

    // moving the invader index
    for (let i=0; i<alienInvaders.length; i++)
        alienInvaders[i] +=direction
    
    // placing the invaders in the new position
    place()

    // GAME OVER criteria - when the invaders hit the shooter(i.e. when the invader and shooter gets into the same square)
    if (squares[currentShooterIndex].classList.contains('invader','shooter'))
    {
        resultDisplay.innerHTML = 'GAME OVER'
		
        clearInterval(invaderID)
		
    }

    //  GAME OVER criteria - when the invaders hit the bottom/ground
    for (let i = 0; i < alienInvaders.length; i++)
    {
        if (alienInvaders[i] > squares.length)
        {
            resultDisplay.innerHTML = 'GAME OVER'
            clearInterval(invaderID)
			
        }
    }

    // YOU WIN criteria - if the number of aliens are equal to the number of aliens removed, you win
    if (aliensRemoved.length === alienInvaders.length)
    {
        resultDisplay.innerHTML = 'YOU WIN'
        clearInterval(invaderID)
		
    }
}

// moves the invaders every 0.5 seconds(500 milliseconds)
invaderID = setInterval(moveInvaders, 500)

// function to create the shooter laser beam
function shoot(e)
 {
    let laserID 
    let currentLaserIndex = currentShooterIndex     //initialize the laser index at the location of the shooter
    
    // function to move the laser beam up vertically
    function moveLaserBeam()
    {
        squares[currentLaserIndex].classList.remove('laser')
        currentLaserIndex -= width
        squares[currentLaserIndex].classList.add('laser')

        // shooting effect (destroying the invader square when the laser beam hits the invader OR when invader and laser beam is in the same square) 
        if (squares[currentLaserIndex].classList.contains('invader'))
        {
            squares[currentLaserIndex].classList.remove('laser')
            squares[currentLaserIndex].classList.remove('invader')
            squares[currentLaserIndex].classList.add('boom')

            // setting a timeout for the boom to disappear
            setTimeout(()=> squares[currentLaserIndex].classList.remove('boom'),300)
            clearInterval(laserID)

            // to get rid of the invader squares in the array so that they are not redrawn/replaced when the invaders are moving
            const invaderRemoved = alienInvaders.indexOf(currentLaserIndex)
            aliensRemoved.push(invaderRemoved)
            results++
            resultDisplay.innerHTML = results
			document.getElementById("score").value = results
			console.log(document.getElementById("score").value)

        }
    }

    //calling the moveLaserBeam function when the arrow up key is pressed
    switch(e.key)
    {
        case 'ArrowUp':
            laserID = setInterval(moveLaserBeam,100)    //the laser square(beam) will travel up a square every 0.1 second
    }
 }  
 
//  calling the shoot function at the event of pressing a key
 document.addEventListener('keydown',shoot)

 
