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
    let parameterForQuestionsAmount;
    const appElement = document.getElementById('quiz-app');
    console.log('App Element:', this.selectedImage); // Add this line
    if (this.selectedImage == "40Questions") {
      parameterForQuestionsAmount = 4
    }
    else {
      parameterForQuestionsAmount = 0
    }
    return {
      countDownResponse: this.records.slice(),
      countdown: 30,
      intervalId: null,
      goodAnswersCounter: 0,
      countDownResponseTimer: parameterForQuestionsAmount,
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



      const answersForCurrentQuestion = [
        this.answer[this.countDownResponseTimer].answer,
        this.answerbad[this.countDownResponseTimer].answerBad,
        this.answerbadfirst[this.countDownResponseTimer].answerBad,
        this.answerbadsecond[this.countDownResponseTimer].answerBad,
      ];
      this.shuffledAnswers = this.shuffleArray(answersForCurrentQuestion);

    },
    shuffleArray(array) {
      for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
      }
      return array;
    },
    function() {
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
      else {
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
  <div class="logInBackground"></div>
  <div class="whole">
    <div class="quizz">
      <div class="question">
        <div class="counterTimer">
          <div class="timer">
            <span v-if="countDownResponseTimer == -1"></span>
            <span v-else>{{ this.countdown }}</span>
          </div>
          <div class="counter">
          </div>
        </div>
        <div class="questionTopic">
          <h1>{{ topic }}</h1>
          <h1 class="questionQuest"
            v-if="countDownResponseTimer >= 0 && countDownResponseTimer < countDownResponse.length">
            {{ countDownResponse[countDownResponseTimer].question }}
          </h1>
          <h1 v-if="countDownResponseTimer == -1">
            Quiz Zakończony!
            <p>Twój wynik: {{ totalScore }}</p>
            <a href="http://localhost:8000/user#">
              <button class="button1">Powrót</button>
            </a>

            <form id="scoreForm" action="/save-score" method="POST">
              <input type="hidden" name="_csrf_token" :value="csrfToken" />
              <input type="hidden" name="score" :value="totalScore" />
              <input type="hidden" name="topic" :value="topic" />
              <input type="hidden" name="topicId" :value="topicId" />
              <button class="button1" type="submit">Zapisz wynik</button>
            </form>
          </h1>
        </div>
        <div class="nextButton">
          <button v-if="countDownResponseTimer >= 0" class="button1"
            @click="toggleQuestion(), counting()">Pomiń</button>
        </div>
      </div>
      <div v-if="countDownResponseTimer >= 0" class="answers">
        <button class="answerButton" v-for="(answer, index) in shuffledAnswers" :key="index"
          @click="checkAnswer(answer), toggleQuestion(), counting()">
          {{ answer }}
        </button>
      </div>
      <div v-else></div>


      <div v-if="countDownResponseTimer == -1">



      </div>
    </div>
  </div>
</template>
