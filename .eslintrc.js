// npm install eslint eslint-config-airbnb eslint-friendly-formatter eslint-loader eslint-plugin-html eslint-plugin-import eslint-plugin-jsx-a11y eslint-plugin-react laravel-mix-eslint eslint-plugin-vue eslint-config-standard eslint-plugin-node eslint-plugin-promise eslint-plugin-standard babel-eslint --save-dev

module.exports = {
  root: true,
  globals: {
    '_': true, // lodash
    'Enumerable': true // linq
  },
  parserOptions: {
    parser: 'babel-eslint'
  },
  env: {
    browser: true,
  },
  extends: [
    'standard', // https://github.com/standard/standard/blob/master/docs/RULES-en.md,
    'plugin:vue/recommended',
    'plugin:prettier/recommended',
    'prettier/vue',
  ],
  // required to lint *.vue files
  plugins: [
    'vue',
    'prettier'
  ],
  // add your custom rules here
  rules: {
    // ESLintが使用する整形ルールのうち、自分がoffにしたいルールなどを指定する
    'vue/prop-name-casing': 'off', // Propsの変数の命名規則について
    'no-console': 'off', // console.log()の使用について
    'no-unused-vars': 'off', // 使われていない変数について
    'camelcase': 'off', // camelcaseについて

    // この先はPrettierのルール
    "prettier/prettier": [
      "error",
      {
        printWidth: 120,
        tabWidth: 2,
        useTabs: false,
        singleQuote: true,
        trailingComma: 'all',
        bracketSpacing: true,
        arrowParens: 'avoid',
        semi: false,
      },
    ]
  }
}
