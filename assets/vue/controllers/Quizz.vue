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
        this.countdown = 30;
        this.intervalId = setInterval(() => {
          this.countdown -= 1;
          if (this.countdown <= 0) {
            clearInterval(this.intervalId);
            this.intervalId = null;
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
        this.shuffleAnswersForCurrentQuestion(); 
      },
      shuffleAnswersForCurrentQuestion() {
        if (this.selectedImage == "40Questions") {
          
        
          const answersForCurrentQuestion = [
            this.answer[this.countDownResponseTimer].answer,
            this.answerbad[this.countDownResponseTimer].answerBad,
            this.answerbadfirst[this.countDownResponseTimer].answerBad,
            this.answerbadsecond[this.countDownResponseTimer].answerBad,
          ];
          this.shuffledAnswers = this.shuffleArray(answersForCurrentQuestion);
        }
      },
      shuffleArray(array) {
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
        this.calculateTotalScore();
      },
      recordContent(record) {
        return record.question;
      },
      calculateTotalScore() {
        console.log("nigger " + this.right)
        if (this.right == 1) {
          this.totalScore += 50 * this.countdown;
        }
        //this.totalScore = totalScore;
      },
    },
    created() {
      console.log("Component created");
      this.countDownResponse = this.records.slice();
      this.shuffleAnswersForCurrentQuestion();
     // this.countDownTimer();
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
      <div v-else></div>
    </div>
    <button @click="toggleQuestion(),counting()">Toggle</button>
    <span v-if="countDownResponseTimer == -1"></span>
    <span v-else>{{ this.countdown }}</span>
    <span v-if="right == 0"></span>
    <span v-if="right == 1">Good</span>
    <span v-if="right == 2">Bad</span>
    <span >{{ goodAnswersCounter }}/{{ countDownResponse.length }} dobrych odpowiedzi</span>
    <div v-if="countDownResponseTimer == -1">
      <h1>Quiz Finished!</h1>
      <p>Your total score is: {{ totalScore }}</p>
      <form id="scoreForm" action="/save-score" method="POST">
        <input type="hidden" name="_csrf_token" :value="csrfToken" />
        <input type="hidden" name="score" :value="totalScore" />
        <input type="hidden" name="topic" :value="topic" />
        <input type="hidden" name="topicId" :value="topicId" />
        <button type="submit">Submit Score</button>
      </form>
    </div>
  </div>
</template>
