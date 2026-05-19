import Engine from './engine';
import BlockComponent from './block-component';

// init blocks
import ImageBlock from './blocks/image';
import HeadingBlock from './blocks/heading';
import SectionBlock from './blocks/section';
import ButtonBlock from './blocks/button';
import Block from './block';


const container = document.getElementById("container");

const engine = (new Engine("123", "Hello World"))
      .adoptBlocks(
        ImageBlock,
        HeadingBlock,
        SectionBlock,
        ButtonBlock,
      );
const workspace = engine.workspace();



const blockComponents: BlockComponent[] = [
  new BlockComponent(
    "123",
    "Hero",
    "hero",
    "description",
    "thumbnail", 
    [
      new Block(
        111,
        "section",
        "section",
        "",
        "__Section",
        { className: "section-hero"  },
        [
          new Block(
            112,
            "heading",
            "h1",
            "Hello World",
            "__Heading",
            { className: "hello-class-world"  },
            [ ],
          ),
           new Block(
            113,
            "heading",
            "h1",
            "Halo dunia",
            "__Heading",
            { className: "hello-class-world"  },
            [ ],
          )
        ],
      )
    ],
  ),
];

for (const blockComponent of blockComponents) {
  workspace.add(blockComponent);
}

console.log("ok");
engine.mount(
  container
);

