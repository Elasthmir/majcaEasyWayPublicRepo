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
  },
  data() {
    return {
      countDownResponse: this.records,
      countdown: 30,
      intervalId: null, // Add this line
      goodAnswersCounter: 0,
      countDownResponseTimer: 4,
      shuffledAnswers: [], // Holds the shuffled answers for the current question
      awesome: false,
      right: 0,
    };
  },
  computed: {
    selectedModeLabel() {
      return this.selectedImage == "fastQuizz" ? "Szybki quiz" : "Pełny quiz";
    },
  },
  methods: {
    counting() {
    // Clear any existing interval
    if (this.intervalId) {
      clearInterval(this.intervalId);
      this.intervalId = null;
    }

    // Initialize the countdown
    this.countdown = 30;

    // Start a new interval and store its ID
    this.intervalId = setInterval(() => {
      console.log('current countdown', this.countdown);
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
      }
      console.log(this.countDownResponseTimer);
      this.shuffleAnswersForCurrentQuestion(); // Shuffle answers when toggling questions
      this.right = 0;
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
      console.log("Selected answer:", answer);
      const correctAnswer = this.answer[this.countDownResponseTimer].answer;
      this.right = answer === correctAnswer ? 1 : 2;
      this.right = answer === correctAnswer ? this.goodAnswersCounter++ : this.goodAnswersCounter;
    },
    recordContent(record) {
      return record.question;
    },
    countDownTimer() {
      // Your countdown logic
    },
  },
  created() {
    console.log("Component created");
    this.countDownResponse = this.records.slice();
    this.shuffleAnswersForCurrentQuestion(); // Initialize with shuffled answers for the first question
    this.countDownTimer();
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
  </div>
</template>
