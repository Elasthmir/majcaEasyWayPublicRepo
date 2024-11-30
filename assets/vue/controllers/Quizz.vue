<script>
export default {
  inheritAttrs: false,
  name: "Quizz",
  props: {
    records: {
      type: Array,
      required: true,
    },
    answer: {
      type: Array,
      required: true,
    },
    answerbad: {
      type: Array,
      required: true,
    },
    answerbadfirst: {
      type: Array,
      required: true,
    },
    answerbadsecond: {
      type: Array,
      required: true,
    },
    topic: {
      type: String,
      required: true,
    },
    selectedImage: {
      type: String,
      required: true,
    },
    csrfToken: {
      type: String,
      required: true,
    },
    saveScoreUrl: {
      type: String,
      required: true,
    },
  },
  data() {
    const appElement = document.getElementById('quiz-app');
    console.log('App Element:', appElement); // Add this line
    return {
      countDownResponse: this.records.slice(),
      countdown: 30,
      intervalId: null,
      goodAnswersCounter: 0,
      countDownResponseTimer: 4,
      shuffledAnswers: [],
      awesome: false,
      right: 0,
      totalScore: 0,

      
    };
  },
  computed: {
    selectedModeLabel() {
      console.log('CSRF Token:', this.csrfToken);
      console.log('Topic:', this.topic);
      return this.selectedImage === "fastQuizz" ? "Szybki quiz" : "Pełny quiz";
    },
    
  },
  methods: {
    counting() {

      if (this.intervalId) {
        clearInterval(this.intervalId);
        this.intervalId = null;
      }
    
    // Initialize the countdown
        this.countdown = 30;

      // Start a new interval and store its ID
      this.intervalId = setInterval(() => {
        //  console.log('current countdown', this.countdown);
        this.countdown -= 1;

        if (this.countdown <= 0) {
          // Stop the interval when countdown reaches zero
          clearInterval(this.intervalId);
          this.intervalId = null;

          // Optionally call another method when countdown ends
          // this.toggleQuestion();
        }
      }, 1000);
    },
    toggleQuestion() {
      if (this.countDownResponseTimer > 0) {
        this.countDownResponseTimer -= 1;
      } else {
        this.countDownResponseTimer = -1;
        this.calculateTotalScore();
      }
      console.log(this.countDownResponseTimer);
      this.shuffleAnswersForCurrentQuestion(); // Shuffle answers when toggling questions
      //this.right = 0;
    },
    shuffleAnswersForCurrentQuestion() {
      // Combine correct and incorrect answers for the current question
      const answersForCurrentQuestion = [
        this.answer[this.countDownResponseTimer].answer,
        this.answerbad[this.countDownResponseTimer].answerBad,
        this.answerbadfirst[this.countDownResponseTimer].answerBad,
        this.answerbadsecond[this.countDownResponseTimer].answerBad,
      ];

      // Shuffle the combined answers
      this.shuffledAnswers = this.shuffleArray(answersForCurrentQuestion);
    },
    shuffleArray(array) {
      // Shuffle the array using Fisher-Yates shuffle
      for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
      }
      return array;
    },
    function () {
      this.counting = true;
    },
    checkAnswer(answer) {
      const correctAnswer = this.answer[this.countDownResponseTimer].answer;
      console.log("Selected answer: ", answer, " Correct i guess: ", this.answer[this.countDownResponseTimer].answer);
      if (answer == correctAnswer) {
        this.right = 1
        console.log("git odp")
        this.goodAnswersCounter++
      }
      else{
        this.right = 2
        console.log("zła odp")
      }
      //this.right = answer == correctAnswer ? this.goodAnswersCounter++ : this.goodAnswersCounter;
      this.calculateTotalScore();
    },
    recordContent(record) {
      return record.question;
    },
    countDownTimer() {
      // Your countdown logic
    },
    calculateTotalScore() {
      // Calculate the total score
      console.log("nigger " + this.right)
     
      if (this.right == 1) {
        
        this.totalScore += 50 * this.countdown; // Multiply correct answers by time left
        
      }
      //
      //this.totalScore = totalScore;
    },
  },
  created() {
    console.log("Component created");
    this.countDownResponse = this.records.slice();
    this.shuffleAnswersForCurrentQuestion(); // Initialize with shuffled answers for the first question
    this.countDownTimer();
    this.counting();
  },
 
 
  
};
</script>
<template>
  <div>
    <h1>{{ topic }}</h1>
    <p>Selected Mode: {{ selectedModeLabel }}</p>
    <ul v-if="records.length">
      <li v-for="(record, index) in records" :key="index">
        <div v-html="recordContent(record)"></div>
      </li>
    </ul>
    <p v-else>No questions available.</p>

    <h1 v-if="countDownResponseTimer >= 0 && countDownResponseTimer < countDownResponse.length">
      {{ countDownResponse[countDownResponseTimer].question }}
    </h1>

    <h1 v-if="countDownResponseTimer == -1">
      nie ma
      <a href="http://localhost:8000/user#">powrót</a>
    </h1>
    <!-- Render shuffled buttons -->
    <div>
      
      <div v-if="countDownResponseTimer >= 0">
        <button
          
          v-for="(answer, index) in shuffledAnswers"
          :key="index"
          @click="checkAnswer(answer),toggleQuestion(),counting()"
        >
          {{ answer }}
        </button>
      </div>
      <div  v-else></div>
    </div>

    <button @click="toggleQuestion(),counting()">Toggle</button>
    <span v-if="countDownResponseTimer == -1"></span>
    <span v-else>{{ this.countdown }}</span>
    <span v-if="right == 0"></span>
    <span v-if="right == 1">Good</span>
    <span v-if="right == 2">Bad</span>
    <span >{{ goodAnswersCounter }}/{{ countDownResponse.length }} dobrych odpowiedzi</span>
    <!-- When the quiz is finished -->
    <div v-if="countDownResponseTimer == -1">
      <h1>Quiz Finished!</h1>
      <p>Your total score is: {{ totalScore }}</p>

      <!-- Form to submit the score -->
      <form id="scoreForm" action="/save-score" method="POST">
        <!-- CSRF token -->
        <input type="hidden" name="_csrf_token" :value="csrfToken" />
        <!-- Hidden input to hold the score -->
        <input type="hidden" name="score" :value="totalScore" />
        <!-- Hidden input to hold the topic -->
        <input type="hidden" name="topic" :value="topic" />

        <!-- Submit button -->
        <button type="submit">Submit Score</button>
      </form>

      <!-- Or you can auto-submit the form using JavaScript -->
    </div>
  </div>
</template>
