document.addEventListener('DOMContentLoaded', () => {
    fetchCandidates();
});

function fetchCandidates() {
    fetch('fetch_candidates.php')
        .then(response => response.json())
        .then(data => {
            const candidatesDiv = document.getElementById('candidates');
            candidatesDiv.innerHTML = '';
            data.forEach(candidate => {
                const candidateDiv = document.createElement('div');
                candidateDiv.className = 'candidate';
                candidateDiv.innerHTML = `
                    <span>${candidate.name}</span>
                    <img src="${candidate.image}" alt="Candidate Image">
                    <img src="${candidate.symbol}" alt="Candidate Symbol">
                    <div class="vote-container">
                        <button class="vote-button" id="vote-${candidate.id}" onclick="vote(${candidate.id})">Vote</button>
                        <div class="indicator" id="indicator-${candidate.id}"></div>
                    </div>
                `;
                candidatesDiv.appendChild(candidateDiv);
            });
        })
        .catch(error => console.error('Error fetching candidates:', error));
}

function vote(candidateId) {
    const indicator = document.getElementById(`indicator-${candidateId}`);
    indicator.style.backgroundColor = 'green';
    setTimeout(() => {
        indicator.style.backgroundColor = 'red';
    }, 1000);

    // Play beep sound
    const beepAudio = document.getElementById('beepAudio');
    beepAudio.play();

    fetch('vote.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ candidateId: candidateId })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert('Error voting for candidate');
        }
    })
    .catch(error => console.error('Error voting:', error));
}
