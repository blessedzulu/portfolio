module.exports = {
  content: ["./src/*.html"],
  defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || [],
};
