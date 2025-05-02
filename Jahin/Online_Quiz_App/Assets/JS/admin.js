// Admin Panel JS Handlers
class AdminPanel {
  constructor() {
    this.initEventListeners();
    this.loadInitialData();
  }

  initEventListeners() {
    // Quiz Management
    document.getElementById('quiz-form')?.addEventListener('submit', (e) => this.handleQuizSave(e));
    document.querySelectorAll('.delete-quiz-btn').forEach(btn => {
      btn.addEventListener('click', (e) => this.handleQuizDelete(e));
    });

    // User Management
    document.getElementById('user-form')?.addEventListener('submit', (e) => this.handleUserSave(e));
  }

  async loadInitialData() {
    try {
      const [quizzes, users] = await Promise.all([
        this.fetchData('/admin/quizzes'),
        this.fetchData('/admin/users')
      ]);
      this.renderQuizzes(quizzes);
      this.renderUsers(users);
    } catch (error) {
      this.showNotification(error.message, 'error');
    }
  }

  async handleQuizSave(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const quizData = Object.fromEntries(formData.entries());

    try {
      const response = await this.postData('/admin/quizzes', quizData);
      this.showNotification('Quiz saved successfully', 'success');
      this.loadInitialData();
    } catch (error) {
      this.showNotification(`Save failed: ${error.message}`, 'error');
    }
  }

  async handleQuizDelete(e) {
    if (!confirm('Are you sure you want to delete this quiz?')) return;
    
    const quizId = e.target.dataset.quizId;
    try {
      await this.deleteData(`/admin/quizzes/${quizId}`);
      this.showNotification('Quiz deleted successfully', 'success');
      this.loadInitialData();
    } catch (error) {
      this.showNotification(`Delete failed: ${error.message}`, 'error');
    }
  }

  async fetchData(endpoint) {
    const response = await fetch(endpoint);
    if (!response.ok) throw new Error('Failed to load data');
    return response.json();
  }

  async postData(endpoint, data) {
    const response = await fetch(endpoint, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });
    if (!response.ok) throw new Error('Operation failed');
    return response.json();
  }

  async deleteData(endpoint) {
    const response = await fetch(endpoint, { method: 'DELETE' });
    if (!response.ok) throw new Error('Delete operation failed');
    return response.json();
  }

  renderQuizzes(quizzes) {
    const container = document.getElementById('quizzes-container');
    if (!container) return;
    
    container.innerHTML = quizzes.map(quiz => `
      <div class="quiz-card">
        <h3>${quiz.title}</h3>
        <p>${quiz.description}</p>
        <button class="delete-quiz-btn" data-quiz-id="${quiz.id}">Delete</button>
      </div>
    `).join('');
  }

  showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
  }
}

// Initialize admin panel when DOM loads
document.addEventListener('DOMContentLoaded', () => new AdminPanel());