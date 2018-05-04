<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"budget"}},
 *     "denormalization_context"={"groups"={"budget"}}
 * })
 * @ORM\Entity(repositoryClass="App\Repository\BudgetRepository")
 */
class Budget
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"budget"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({"budget"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Groups({"budget"})
     * @ORM\ManyToMany(targetEntity="App\Entity\Goal", inversedBy="budgets")
     */
    private $goal;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Expense", inversedBy="budgets")
     */
    private $expense;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Income", inversedBy="budgets")
     */
    private $income;

    /**
     * @Groups({"budget"})
     * @ORM\ManyToMany(targetEntity="App\Entity\BudgetCategory", inversedBy="budgets")
     */
    private $category;

    public function __construct()
    {
        $this->goal = new ArrayCollection();
        $this->expense = new ArrayCollection();
        $this->income = new ArrayCollection();
        $this->category = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Goal[]
     */
    public function getGoal(): Collection
    {
        return $this->goal;
    }

    public function addGoal(Goal $goal): self
    {
        if (!$this->goal->contains($goal)) {
            $this->goal[] = $goal;
        }

        return $this;
    }

    public function removeGoal(Goal $goal): self
    {
        if ($this->goal->contains($goal)) {
            $this->goal->removeElement($goal);
        }

        return $this;
    }

    /**
     * @return Collection|Expense[]
     */
    public function getExpense(): Collection
    {
        return $this->expense;
    }

    public function addExpense(Expense $expense): self
    {
        if (!$this->expense->contains($expense)) {
            $this->expense[] = $expense;
        }

        return $this;
    }

    public function removeExpense(Expense $expense): self
    {
        if ($this->expense->contains($expense)) {
            $this->expense->removeElement($expense);
        }

        return $this;
    }

    /**
     * @return Collection|Income[]
     */
    public function getIncome(): Collection
    {
        return $this->income;
    }

    public function addIncome(Income $income): self
    {
        if (!$this->income->contains($income)) {
            $this->income[] = $income;
        }

        return $this;
    }

    public function removeIncome(Income $income): self
    {
        if ($this->income->contains($income)) {
            $this->income->removeElement($income);
        }

        return $this;
    }

    /**
     * @return Collection|BudgetCategory[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(BudgetCategory $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(BudgetCategory $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }
}
