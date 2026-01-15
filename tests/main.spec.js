const { promisify } = require("util");
const exec = promisify(require("child_process").exec);

describe("When input is empty", () => {
  it("should return an empty string", async () => {
    const { stdout } = await exec("./bin/vendor-machine");
    expect(stdout).toEqual(expect.stringContaining("empty input"));
  });
});

describe("when input is valid", () => {
  it.each`
    input                                   | result
    ${"1, 0.25, 0.25, GET-SODA"}            | ${"SODA"}
    ${"0.10, 0.10, RETURN-COIN"}            | ${"0.10, 0.10"}
    ${"1, GET-WATER"}                       | ${"WATER, 0.25, 0.10"}
  `("should return '$result' for '$input'", async ({ input, result }) => {
    const { stdout } = await exec(`./bin/vendor-machine "${input}"`);
    expect(stdout).toEqual(expect.stringContaining(result));
  });
});
