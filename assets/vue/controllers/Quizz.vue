<script>
export default {
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
      answers: ["good", "bad_1", "bad_2", "bad_3"],
      countDownResponseTimer: 1,
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
    toggleQuestion() {
      console.log("Component mounted123"); // Ensure Vue instance is mounted
      if (this.countDownResponseTimer > 0) {
        this.countDownResponseTimer -= 1;
      } else {
        this.countDownResponseTimer = this.countDownResponse.length - 1;
      }
      console.log("Timer:", this.countDownResponseTimer);
      console.log("Current Question:", this.countDownResponse[this.countDownResponseTimer]?.question);
      this.randomList(this.answers)
      //this.randomList(this.countDownResponse)
      this.right = 0
      console.log(this.answer);
    },

    recordContent(record) {

      return record.question;
    },
    countDownTimer() {
      // Your countdown logic
    },
    randomList(rand) {
      rand.sort(() => 0.5 - Math.random());
    },
    checkAnswer(answer) {
      this.right = answer === "good" ? 1 : 2;
    },
  },
  created() {
    console.log("Component created"); // Ensure Vue instance is created
    this.countDownResponse = this.records.slice(); // Initialize the array
    this.countDownTimer();
    //this.randomList(this.countDownResponse);
    //this.randomList(this.answers);

  },
  mounted() {

    console.log("Records:", this.records); // Check the passed props
  },
};
</script>

<template>
  <div>
    <h1>{{ topic }}</h1>
    <p>Selected Mode: {{ selectedModeLabel }}</p>
    <ul v-if="records.length">
      <li v-for="(record, index) in records" :key="index">
        <!-- Display the question content -->
        <div v-html="recordContent(record)"></div>
      </li>
    </ul>
    <p v-else>No questions available.</p>
  </div>

  <button @click="toggleQuestion()">Toggle</button>
  <br />
  <button @click="checkAnswer(answers[0])">{{ answers[0] }}</button><br />
  <button @click="checkAnswer(answers[1])">{{ answers[1] }}</button><br />
  <button @click="checkAnswer(answers[2])">{{ answers[2] }}</button><br />
  <button @click="checkAnswer(answers[3])">{{ answers[3] }}</button><br />
  <h1 v-if="countDownResponseTimer > 0 && countDownResponseTimer < countDownResponse.length">
    {{ countDownResponse[countDownResponseTimer].question }}
  </h1>
  <h1 v-else>No questions available.</h1>
  <span v-if="right == 0"></span>
  <span v-if="right == 1">good</span>
  <span v-if="right == 2">bad</span>
</template>

<style>
/* Include any component-specific styles here */
</style>
